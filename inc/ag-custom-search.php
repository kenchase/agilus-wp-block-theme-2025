<?php // Register custom search block style
function register_custom_search_block_style()
{
    register_block_style(
        'core/search',
        array(
            'name'         => 'ag-client-search-form',
            'label'        => __('AG Client Search Form', 'your-text-domain'),
            'inline_style' => '.wp-block-search.is-style-ag-client-search-form',
        )
    );

    // Add script to handle the custom style
    add_action('wp_footer', 'custom_search_block_script');
}
add_action('init', 'register_custom_search_block_style');

function custom_search_block_script()
{
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Target only search blocks with your custom style
            const customSearchBlocks = document.querySelectorAll('.wp-block-search.is-style-ag-client-search-form');

            customSearchBlocks.forEach(function(form) {
                // Change the form action to your custom URL
                form.setAttribute('action', '<?php echo esc_url(home_url("/clients/client-search-results/")); ?>');

                // Change input name from 's' to 'q' if needed
                const searchInput = form.querySelector('.wp-block-search__input');
                if (searchInput) {
                    searchInput.setAttribute('name', 'q');
                }

                // Add hidden field to identify this form
                const hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', 'search_source');
                hiddenField.setAttribute('value', 'ag_client_search');
                form.appendChild(hiddenField);
            });
        });
    </script>
<?php
}

/**
 * Override Query Loop block content
 */

function ag_adjust_queries($query)
{
    // Candidate Search Results page
    if (!is_admin() && is_page('candidate-search-results') && $query->is_main_query()) {
        echo ('wifwhefiwhfiwhfiwhei');
        $query->set('posts_per_page', 1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }

    // Client Search Results page
    if (!is_admin() && is_page('client-search-results') && $query->is_main_query()) {
        add_filter('render_block', 'override_client_query_loop_block', 10, 2);
    }
}
add_action('pre_get_posts', 'ag_adjust_queries');

function override_client_query_loop_block($block_content, $block)
{
    // Only target Query Loop blocks
    if ($block['blockName'] !== 'core/query') {
        return $block_content;
    }

    // Get block attributes (useful for conditional overrides)
    $attributes = $block['attrs'];

    // Optional: Only override specific Query Loop blocks
    // For example, by checking for a specific className or ID
    if (isset($attributes['className']) && strpos($attributes['className'], 'ag-client-custom-query') === false) {
        return $block_content;
    }

    // Start output buffering to capture our custom query
    ob_start();

    // Setup your custom query
    $search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
    $search_source = isset($_GET['search_source']) ? sanitize_text_field($_GET['search_source']) : '';

    $custom_query = ag_make_search_query($search_query, $search_source);

    // Get the inner template blocks
    $template_blocks = isset($block['innerBlocks'][0]['innerBlocks']) ? $block['innerBlocks'][0]['innerBlocks'] : [];

    // Start the loop
    if ($custom_query->have_posts()) :
        echo '<div class="custom-query-loop">';

        while ($custom_query->have_posts()) : $custom_query->the_post();
            // You have two options here:

            // Option 1: Re-use the inner blocks (template) from the Query Loop
            // This preserves the layout/content structure from the block editor
            echo '<div class="custom-query-item">';
            foreach ($template_blocks as $inner_block) {
                echo render_block($inner_block);
            }
            echo '</div>';

        endwhile;

        echo '</div>';

    // Optional: Add custom pagination
    // wp_reset_postdata();
    endif;

    // Get the buffered content
    $custom_content = ob_get_clean();

    // Return your custom content
    return $custom_content;
}


/*************** Custom Query */

function ag_make_search_query($search_query, $search_source)
{

    // Determine which search source to use
    $parent_page_slug = 'job-seekers';
    $cat_term_slug = 'job-seekers';
    if ($search_source === 'ag_client_search') {
        $parent_page_slug = 'clients';
        $cat_term_slug = 'clients';
    }

    // 1. Get the Clients page and its children (pages)
    $clients_page = get_page_by_path($parent_page_slug);
    $page_ids = array();

    if ($clients_page) {
        // Add the Clients page itself
        $page_ids[] = $clients_page->ID;

        // Get all children of the Clients page
        $children = get_pages(array('child_of' => $clients_page->ID));
        foreach ($children as $child) {
            $page_ids[] = $child->ID;
        }
    }

    // 2. Get posts with Clients category
    $category_query = new WP_Query(array(
        'post_type' => 'post',
        'category_name' => $cat_term_slug,
        'fields' => 'ids', // Only get post IDs
        'posts_per_page' => -1
    ));
    $post_ids = $category_query->posts;

    // 3. Combine all IDs for the master query
    $all_ids = array_merge($page_ids, $post_ids);

    // 4. Run the master query if we have IDs to query
    if (!empty($all_ids)) {
        $args = array(
            's' => $search_query,
            'post__in' => $all_ids,
            'posts_per_page' => -1,
            'orderby' => 'title', // Adjust ordering as needed
            'order' => 'ASC'
        );

        $results = new WP_Query($args);

        // Now $master_query contains all the posts and pages you want
    }

    return $results;
}

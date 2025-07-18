<?php

/*** */


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
        echo ('Client Search Results');
        add_filter('render_block', 'override_client_query_loop_block', 10, 2);
    }
}
add_action('pre_get_posts', 'ag_adjust_queries');


/**
 * Override Query Loop block content
 */
// add_filter('render_block', 'override_query_loop_block', 10, 2);

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
    if (isset($attributes['className']) && strpos($attributes['className'], 'my-custom-query') === false) {
        return $block_content;
    }

    // Start output buffering to capture our custom query
    ob_start();

    // Setup your custom query
    $custom_query_args = array(
        'post_type' => 'post', // or your custom post type
        'posts_per_page' => 1, // or any other number
        'orderby' => 'title',
        'order' => 'ASC',
        // Add any additional query parameters
    );

    // You can access the original query parameters if needed
    if (isset($attributes['query'])) {
        // Merge with original pagination if it exists
        if (isset($attributes['query']['pages'])) {
            $custom_query_args['paged'] = $attributes['query']['pages'];
        }
    }

    $custom_query = new WP_Query($custom_query_args);

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

        // Option 2: Custom HTML for each post
        // Uncomment to use instead of Option 1
        /*
    echo '<article id="post-' . get_the_ID() . '" class="custom-post">';
        echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
        echo '<div class="entry-content">' . get_the_excerpt() . '</div>';
        echo '</article>';
    */

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

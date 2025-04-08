<?php
// Register custom search block style
function ag_register_custom_search_block_style()
{
    register_block_style(
        'core/search',
        array(
            'name'         => 'ag-client-search-form',
            'label'        => __('Client', 'agilus'),
            'inline_style' => '.wp-block-search.is-style-ag-client-search-form',
        )
    );

    register_block_style(
        'core/search',
        array(
            'name'         => 'ag-job-seeker-search-form',
            'label'        => __('Job Seeker', 'agilus'),
            'inline_style' => '.wp-block-search.is-style-ag-job-seeker-search-form',
        )
    );

    // Add script to handle the custom style
    add_action('wp_footer', 'ag_custom_search_block_script');
}
add_action('init', 'ag_register_custom_search_block_style');

/*
 * Enqueue custom script for search block
 * This script will modify the form action and input name based on the block style
 * 
 * To-do: Remove duplicate code
 */
function ag_custom_search_block_script()
{
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Target only search blocks with your custom style
            const customClientSearchBlocks = document.querySelectorAll('.wp-block-search.is-style-ag-client-search-form');
            const customJobSeekerSearchBlocks = document.querySelectorAll('.wp-block-search.is-style-ag-job-seeker-search-form');

            customClientSearchBlocks.forEach(function(form) {
                // Display the search bar if on the search results page
                const searchBar = document.querySelector('.top-nav-search-bar');
                const currentUrl = window.location.href;
                if (currentUrl.includes('clients/search-results')) {
                    if (searchBar) {
                        searchBar.classList.add('visible');
                    }
                }
                // Change the form action to your custom URL
                form.setAttribute('action', '<?php echo esc_url(home_url("/clients/search-results/")); ?>');

                // Change input name from 's' to 'q' t prevent conflict with the default WordPress search
                const searchInput = form.querySelector('.wp-block-search__input');
                if (searchInput) {
                    searchInput.setAttribute('name', 'q');
                }

                // Update the value of the search input to the query parameter
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get('q');
                if (searchQuery) {
                    searchInput.value = searchQuery;
                }

                // Add hidden field to identify this form
                const hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', 'search_source');
                hiddenField.setAttribute('value', 'ag_client_search');
                form.appendChild(hiddenField);
            });

            customJobSeekerSearchBlocks.forEach(function(form) {
                // Display the search bar if on the search results page
                const searchBar = document.querySelector('.top-nav-search-bar');
                const currentUrl = window.location.href;
                if (currentUrl.includes('clients/search-results')) {
                    if (searchBar) {
                        searchBar.classList.add('visible');
                    }
                }
                // Change the form action to your custom URL
                form.setAttribute('action', '<?php echo esc_url(home_url("/job-seekers/search-results/")); ?>');

                // Change input name from 's' to 'q' t prevent conflict with the default WordPress search
                const searchInput = form.querySelector('.wp-block-search__input');
                if (searchInput) {
                    searchInput.setAttribute('name', 'q');
                }

                // Add hidden field to identify this form
                const hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', 'search_source');
                hiddenField.setAttribute('value', 'ag_job_seeker_search');
                form.appendChild(hiddenField);

                // Update the value of the search input to the query parameter
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get('q');
                if (searchQuery) {
                    searchInput.value = searchQuery;
                }
            });
        });
    </script>
<?php
}

/** 
 * On our custom search results page (clients, job seekers), we want to modify the query to search for the 'q' parameter
 * This shouldn't impact the default WordPress search results page which uses the 's' parameter.
 * It's assumed that if the q parameter is in the URL, on of the custom search results page is being viewed
 * */
function wpdocs_randomize_query($query)
{
    if (isset($_GET['q'])) {
        $query['s'] = sanitize_text_field($_GET['q']);
    }
    return $query;
}
add_filter('query_loop_block_query_vars', 'wpdocs_randomize_query', 10, 3);

/**  
 * We use two custom search results pages (clients, job seekers). We never want the default search results page to show.
 * */
function ag_redirect_search_page()
{
    if (is_search()) {
        wp_redirect(home_url());
        exit();
    }
}
add_action('template_redirect', 'ag_redirect_search_page');

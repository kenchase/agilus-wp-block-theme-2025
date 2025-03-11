<?php
// Enqueues style.css on the front.
if (! function_exists('agilus_enqueue_styles')) :
    /**
     * Enqueues style.css on the front.
     *
     * @since Agilus 1.0
     *
     * @return void
     */
    function agilus_enqueue_styles()
    {
        wp_enqueue_style(
            'agilus-style',
            get_parent_theme_file_uri('style.css'),
            array(),
            wp_get_theme()->get('Version')
        );
    }
endif;
add_action('wp_enqueue_scripts', 'agilus_enqueue_styles');

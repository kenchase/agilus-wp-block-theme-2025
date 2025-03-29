<?php

/**
 * Disable certain things from the block editor selector
 */


function agilus_block_editor_config()
{
    remove_theme_support('core-block-patterns'); // Remove all WordPress default block patterns. We only want to make theme-specific patterns available
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets'); // Remove the block directory assets from the block editor. Otherwise, an "Available to install" section will show up in the block inserter    
}
add_action('init', 'agilus_block_editor_config');

/**
 * Enqueues css on the front-end.
 */
if (! function_exists('agilus_enqueue_styles')) {
    function agilus_enqueue_styles()
    {
        wp_enqueue_style('dashicons');
        wp_enqueue_style(
            'agilus-style',
            get_parent_theme_file_uri('style.css'),
            array('dashicons'),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'agilus_enqueue_styles');

/**
 * Enqueues js scripts on the front-end.
 */
if (! function_exists('agilus_enqueue_scripts')) {
    function agilus_enqueue_scripts()
    {
        wp_enqueue_script(
            'agilus-scripts',
            get_template_directory_uri() . '/scripts.js',
            array(),
            1.0,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'agilus_enqueue_scripts');

require_once(get_template_directory() .  '/inc/ag-custom-blocks.php');
// require_once(get_template_directory() .  '/inc/ag-patterns.php');
require_once(get_template_directory() .  '/inc/ag-custom-search.php');
require_once(get_template_directory() .  '/inc/ag-custom-nav.php');

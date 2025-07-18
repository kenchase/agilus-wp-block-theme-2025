<?php

/**
 * Block editor customizations.
 */
function agilus_theme_setup()
{
    // Remove all WordPress default block patterns. We only want to make theme-specific patterns available
    remove_theme_support('core-block-patterns');
    // Remove the block directory assets from the block editor. Otherwise, an "Available to install" section will show up in the block inserter
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
    // Disable remote patterns from the WordPress.org Pattern Directory
    add_filter('should_load_remote_block_patterns', '__return_false');
}
add_action('after_setup_theme', 'agilus_theme_setup');

/**
 * Add category support to pages
 */
function agilus_add_categories_to_pages()
{
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'agilus_add_categories_to_pages');

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

/** Add CSS to the Gutenberg editor */

// Gutenberg custom stylesheet
add_theme_support('editor-styles');
add_editor_style('style.css'); // make sure path reflects where the file is located

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

/**
 * Redirect the Site Logo block link to the current section (clients or job seekers).
 * Use this hook: render_block_core/site-logo
 */

function ag_change_site_logo_block_link($block_content, $block)
{
    // Set up some custom URLs based on the block's className
    $custom_url = '';

    // Check if className exists before using str_contains
    $className = isset($block['attrs']['className']) ? $block['attrs']['className'] : '';

    if (str_contains($className, 'is-job-seekers')) {
        $custom_url = home_url() . '/job-seekers/'; // Replace with your desired URL
    } elseif (str_contains($className, 'is-clients')) {
        $custom_url = home_url() . '/clients/'; // Replace with your desired URL
    } else {
        return $block_content; // Return the original content if no class is found
    }

    // Replace the home URL with a custom URL
    $block_content = preg_replace(
        '/(<a\s+[^>]*href=[\'"])' . preg_quote(rtrim(home_url(), '/'), '/') . '\/?([\'"][^>]*>)/i',
        '$1' . esc_url($custom_url) . '$2',
        $block_content
    );

    return $block_content;
}

add_filter('render_block_core/site-logo', 'ag_change_site_logo_block_link', 10, 2);

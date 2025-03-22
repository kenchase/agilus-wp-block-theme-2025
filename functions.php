<?php

/**
 * Enqueues style.css on the front-end.
 */
if (! function_exists('agilus_enqueue_styles')) {
    function agilus_enqueue_styles()
    {
        wp_enqueue_style(
            'agilus-style',
            get_parent_theme_file_uri('style.css'),
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'agilus_enqueue_styles');

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function ag_register_acf_blocks()
{
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type(__DIR__ . '/blocks/team-member');
}
// Here we call our tt3child_register_acf_block() function on init.
// add_action('init', 'ag_register_acf_blocks');

<?php

/**
 * Add custom category for custom Agilus blocks
 */
add_filter('block_categories_all', 'ag_new_block_category');

function ag_new_block_category($block_categories)
{

    $block_categories[] = array(
        'slug' => 'agilus-blocks',
        'title' => 'Agilus Blocks'
    );

    return $block_categories;
}

/**
 * Register custom blocks
 */

// Team Member Role
function ag_register_tm_role_block()
{
    register_block_type(__DIR__ . '/blocks/ag-team-member-role');
}
add_action('init', 'ag_register_tm_role_block');

// Team Member LinkedIn Link
function ag_register_tm_li_block()
{
    register_block_type(__DIR__ . '/blocks/ag-team-member-linkedin');
}

add_action('init', 'ag_register_tm_li_block');

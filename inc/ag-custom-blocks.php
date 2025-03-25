<?php

/**
 * Add custom category for custom Agilus blocks
 */

function ag_new_block_category($block_categories)
{
    $block_categories[] = array(
        'slug' => 'agilus-blocks',
        'title' => 'Agilus Blocks'
    );

    return $block_categories;
}
add_filter('block_categories_all', 'ag_new_block_category');

/**
 * Register custom blocks
 */

// Team Member Role
function ag_register_tm_role_block()
{
    register_block_type(__DIR__ . '/../blocks/ag-team-member-role');
}
add_action('init', 'ag_register_tm_role_block');

// Team Member LinkedIn Link
function ag_register_tm_li_block()
{
    register_block_type(__DIR__ . '/../blocks/ag-team-member-linkedin');
}
add_action('init', 'ag_register_tm_li_block');

// Latest Jobs Block
function ag_register_latest_jobs_block()
{
    register_block_type(__DIR__ . '/../blocks/ag-latest-jobs');
}
add_action('init', 'ag_register_latest_jobs_block');

// Search Toggle Block
function ag_register_search_toggle_block()
{
    register_block_type(__DIR__ . '/../blocks/ag-search-toggle');
}
add_action('init', 'ag_register_search_toggle_block');

// FAQs Block
function ag_register_faq_block()
{
    register_block_type(__DIR__ . '/../blocks/ag-faqs');
}
add_action('init', 'ag_register_faq_block');

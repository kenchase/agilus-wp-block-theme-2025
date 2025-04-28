<?php

/**
 * Icon Link.
 *
 * Modify the output of the navigation link block to include a Font Awesome icon.
 * Find icons here: https://fontawesome.com/search
 */

function ag_custom_navigation_link($block_content, $block)
{
    // Check if the block has a 'className' attribute
    if (isset($block['attrs']['className'])) {
        $block_class = $block['attrs']['className'];
    } else {
        return $block_content;
    }

    // Menu has the 'fa-' class. It's assumed this is intended for Font Awesome icons.
    if (str_contains($block_class, 'fa-')) {
        // Remove the font awesome class names from the list item
        $modified_content = str_replace(
            $block_class,
            '',
            $block_content
        );
        // Add the font awesome icon to the link and hide the label
        $modified_content = str_replace(
            '<span class="wp-block-navigation-item__label">',
            '<i class="' . esc_attr($block_class) . '"></i><span class="wp-block-navigation-item__label visually-hidden">',
            $modified_content
        );
        return $modified_content;
    }
}

add_filter('render_block_core/navigation-link', 'ag_custom_navigation_link', 10, 2);

function ag_custom_navigation_submenu($block_content, $block)
{

    // Check if the block has a 'className' attribute
    if (isset($block['attrs']['className'])) {
        $block_class = $block['attrs']['className'];
    } else {
        return $block_content;
    }
    // Menu has the 'fa-' class. It's assumed this is intended for Font Awesome icons.
    if (str_contains($block_class, 'fa-')) {
        // Remove the font awesome class names from the list item
        $modified_content = str_replace(
            $block_class,
            '',
            $block_content
        );

        // print_r($block_content);
        $modified_content = agMakeSubmenuParentIcon($modified_content, $block_class);
        return $modified_content;
    }
}

add_filter('render_block_core/navigation-submenu', 'ag_custom_navigation_submenu', 10, 2);

function agMakeSubmenuParentIcon($html, $block_class = '')
{
    // Use a regular expression to find the first anchor tag
    $pattern = '/<a\s+([^>]*)>([^<]*)<\/a>/i';

    // Replace the content of the first anchor tag with a span-wrapped version
    return preg_replace_callback($pattern, function ($matches) use ($block_class) {
        $attributes = $matches[1]; // All attributes of the anchor tag
        $content = $matches[2];    // The content inside the anchor tag

        // Return the anchor tag with the content wrapped in a span
        return "<a {$attributes}><i class=\"" . $block_class . "\"></i><span class=\"wp-block-navigation-item__label visually-hidden\">{$content}</span></a>";
    }, $html, 1); // The '1' limits the replacement to only the first occurrence
}

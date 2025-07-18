<?php

/**
 * Wrapper Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block content (empty string).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 */

// Get block ID and class names
$block_id = !empty($block['anchor']) ? $block['anchor'] : '';
$class_name = 'wrapper-block ag-content-index';

// Add block ID attribute
$id_attr = $block_id ? ' id="' . esc_attr($block_id) . '"' : '';

// Get the block attributes (https://www.advancedcustomfields.com/resources/acf-blocks-using-get_block_wrapper_attributes/)
$style_attrs = $is_preview ? ' ' : get_block_wrapper_attributes(
    array(
        'class' => $class_name,
    )
);
?>

<div <?php echo ($id_attr); ?> <?php echo ($style_attrs); ?>>
    <InnerBlocks />
</div>
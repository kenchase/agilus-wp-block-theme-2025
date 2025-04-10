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

// Add alignment class
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Add alignment class
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Add block ID attribute
$id_attr = $block_id ? ' id="' . esc_attr($block_id) . '"' : '';

// Block styles
$block_style = '';
if (!empty($block['style'])) {
    // Background and text colors are managed through block supports
    if (!empty($block['style']['color']['background'])) {
        $block_style .= 'background-color:' . $block['style']['color']['background'] . ';';
    }
    if (!empty($block['style']['color']['text'])) {
        $block_style .= 'color:' . $block['style']['color']['text'] . ';';
    }

    // Handle spacing (margin and padding)
    if (!empty($block['style']['spacing'])) {
        $spacing = $block['style']['spacing'];

        if (!empty($spacing['padding'])) {
            foreach ($spacing['padding'] as $side => $value) {
                $block_style .= 'padding-' . $side . ':' . $value . ';';
            }
        }

        if (!empty($spacing['margin'])) {
            foreach ($spacing['margin'] as $side => $value) {
                $block_style .= 'margin-' . $side . ':' . $value . ';';
            }
        }
    }
}

$style_attr = !empty($block_style) ? ' style="' . esc_attr($block_style) . '"' : '';
?>

<div<?php echo $id_attr; ?> class="<?php echo esc_attr($class_name); ?>" <?php echo $style_attr; ?>>
    <InnerBlocks />
    </div>
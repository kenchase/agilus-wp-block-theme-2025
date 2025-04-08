<?php

/**
 * AG Branch Block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Create class attribute allowing for custom className and align values.
$className = 'ag-branch';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
if (!empty($block['alignText'])) {
    $className .= ' has-text-align-' . $block['alignText'];
}

// Handle specific style variations
if (!empty($block['style']['name'])) {
    if ($block['style']['name'] === 'lead') {
        $className .= ' is-style-lead';
    } elseif ($block['style']['name'] === 'drop-cap') {
        $className .= ' has-drop-cap';
    }
}

// Load the field value.
$branch_address_1 = get_field('ag-br-address-1', $post_id);
$branch_city = get_field('ag-br-city', $post_id);
$branch__prov = get_field('ag-br-prov', $post_id);
$branch_postal = get_field('ag-br-postal', $post_id);
$branch_tel = get_field('ag-br-telephone', $post_id);
$branch_email = get_field('ag-br-email', $post_id);

if (empty($branch_address_1) && $is_preview) {
    $branch_address_1  = 'Team member LinkedIn placeholder here';
}

// Build style attribute
$style = '';
$blockStyles = [];
// Style generation with block supports
if (function_exists('wp_style_engine_get_styles')) {
    $blockStyles = wp_style_engine_get_styles([
        'typography' => !empty($block['typography']) ? $block['typography'] : [],
        'spacing' => !empty($block['spacing']) ? $block['spacing'] : [],
    ]);

    if (!empty($blockStyles['css'])) {
        $style = $blockStyles['css'];
    }
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($style); ?>">
    <ul class="ag-branch__list">
        <li class="ag-branch__list-item"><?php echo (esc_html($branch_address_1)); ?></li>
        <li class="ag-branch__list-item"><?php echo (esc_html($branch_city) . ', ' . esc_html($branch__prov)); ?></li>
        <li class="ag-branch__list-item"><?php echo (esc_html($branch_postal)); ?></li>
        <li class="ag-branch__list-item"><a href="tel:<?php echo (esc_html($branch_tel)); ?>"><?php echo (esc_html($branch_tel)); ?></a></li>
        <li class="ag-branch__list-item"><a href="mailto:<?php echo (esc_html($branch_email)); ?>"><?php echo (esc_html($branch_email)); ?></a></li>
    </ul>

</div>
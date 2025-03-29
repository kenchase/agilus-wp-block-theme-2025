<?php

/**
 * AG Location LinkedIn Block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom anchor values
$id = 'ag-location-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom className and align values.
$className = 'ag-location';
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
$location_address_1 = get_field('ag-br-address-1', $post_id);
$location_city = get_field('ag-br-city', $post_id);
$location__prov = get_field('ag-br-prov', $post_id);
$location_postal = get_field('ag-br-postal', $post_id);
$location_tel = get_field('ag-br-telephone', $post_id);
$location_email = get_field('ag-br-email', $post_id);

if (empty($location_address_1) && $is_preview) {
    $location_address_1  = 'Team member LinkedIn placeholder here';
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
    <ul>
        <li><?php echo (esc_html($location_address_1)); ?></li>
        <li><?php echo (esc_html($location_city) . ', ' . esc_html($location__prov)); ?></li>
        <li><?php echo (esc_html($location_postal)); ?></li>
        <li><a href="tel:<?php echo (esc_html($location_tel)); ?>"><?php echo (esc_html($location_tel)); ?></a></li>
        <li><a href="mailto:<?php echo (esc_html($location_email)); ?>"><?php echo (esc_html($location_email)); ?></a></li>
    </ul>

</div>
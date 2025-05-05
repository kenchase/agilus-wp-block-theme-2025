<?php

/**
 * AG Branch Block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Get the post id of the page/post being viewed
global $wp_query;
$global_post_id = $wp_query->post->ID;

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
$branch_prov = get_field('ag-br-prov', $post_id);
$branch_postal = get_field('ag-br-postal', $post_id);
$branch_tel = get_field('ag-br-telephone', $post_id);
$branch_email = get_field('ag-br-email', $post_id);
$branch_client_form_url = get_field('ag-br-client-form', $post_id);
$branch_js_form_url = get_field('ag-br-job-seeker-form', $post_id);
$branch_form_url = "";

if (has_category('clients', $global_post_id)) {
    $branch_form_url = $branch_client_form_url;
}
if (has_category('job-seekers', $global_post_id)) {
    $branch_form_url = $branch_js_form_url;
}

// Build style attribute
$style = '';
$blockStyles = [];
// Style generation with block support
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

<div class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($style); ?>">
    <ul class="ag-branch__list">
        <?php if ($branch_address_1) { ?>
            <li class="ag-branch__list-item"><?php echo (esc_html($branch_address_1)); ?></li>
        <?php } ?>
        <?php if ($branch_city && $branch_prov) { ?>
            <li class="ag-branch__list-item"><?php echo (esc_html($branch_city) . ', ' . esc_html($branch_prov)); ?></li>
        <?php } ?>
        <?php if ($branch_postal) { ?>
            <li class="ag-branch__list-item ag-branch__list-spacer"><?php echo (esc_html($branch_postal)); ?></li>
        <?php } ?>
        <?php if ($branch_tel) { ?>
            <li class="ag-branch__list-item"><i class="fa-solid fa-phone"></i> <a href="tel:<?php echo (esc_html($branch_tel)); ?>"><?php echo (esc_html($branch_tel)); ?></a></li>
        <?php } ?>
        <?php if ($branch_email) { ?>
            <li class="ag-branch__list-item"><i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo (esc_html($branch_email)); ?>"><?php echo (esc_html($branch_email)); ?></a></li>
        <?php } ?>
        <?php if ($branch_form_url) { ?>
            <li class="ag-branch__list-item"><i class="fa-solid fa-envelope"></i> <a href="<?php echo (esc_html($branch_form_url)); ?>"><?php echo _e('Contact form', 'agilus') ?></a></li>
        <?php } ?>
    </ul>
</div>
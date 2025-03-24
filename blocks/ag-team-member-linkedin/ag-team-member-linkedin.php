<?php

/**
 * AG Team Member LinkedIn Block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom anchor values
$id = 'ag-team-member-linkedin-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom className and align values.
$className = 'ag-team-member-linkedin';
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
$team_member_linkedin = get_field('ag-tm-linkedin-url', $post_id);
if (empty($team_member_linkedin) && $is_preview) {
    $team_member_linkedin = 'Team member LinkedIn placeholder here';
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
<?php if ($team_member_linkedin) { ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($style); ?>">
        <a class="ag-linkedin-content" href="<?php echo esc_html($team_member_linkedin); ?>">
            <?php echo esc_html($team_member_linkedin); ?>
        </a>
    </div>
<?php } ?>
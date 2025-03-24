<?php

/**
 * AG Team Member Role Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom anchor values
$id = 'ag-team-member-role-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom className and align values.
$className = 'ag-team-member-role';
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
$team_member_role = get_field('ag-tm-role', $post_id);
if (empty($team_member_role) && $is_preview) {
    $team_member_role = 'Team member role placeholder here';
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
<?php if ($team_member_role) { ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($style); ?>">
        <p class="ag-role-content">
            <?php echo esc_html($team_member_role); ?>
        </p>
    </div>
<?php } ?>
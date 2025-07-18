<?php

/**
 * AG Team Member Role Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

$team_member_role = get_field('ag-tm-role', $post_id);

// Get block ID and class names
$block_id = !empty($block['anchor']) ? $block['anchor'] : '';
$className = 'ag-team-member-role';

// Add block ID attribute
$id_attr = $block_id ? ' id="' . esc_attr($block_id) . '"' : '';

// Get the block attributes (https://www.advancedcustomfields.com/resources/acf-blocks-using-get_block_wrapper_attributes/)
$style_attrs = $is_preview ? ' ' : get_block_wrapper_attributes(
    array(
        'class' => $class_name,
    )
);
?>
<?php if ($team_member_role) { ?>
    <div <?php echo ($id_attr); ?> <?php echo ($style_attrs); ?>>
        <p class="ag-tm-role__text">
            <?php echo esc_html($team_member_role); ?>
        </p>
    </div>
<?php } ?>
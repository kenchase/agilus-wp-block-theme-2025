<?php

/**
 * AG Team Member LinkedIn Block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

$team_member_linkedin = get_field('ag-tm-linkedin-url', $post_id);

// Get block ID and class names
$block_id = !empty($block['anchor']) ? $block['anchor'] : '';
$class_name = 'ag-team-member-linkedin';

// Add block ID attribute
$id_attr = $block_id ? ' id="' . esc_attr($block_id) . '"' : '';

// Get the block attributes (https://www.advancedcustomfields.com/resources/acf-blocks-using-get_block_wrapper_attributes/)
$style_attrs = $is_preview ? ' ' : get_block_wrapper_attributes(
    array(
        'class' => $class_name,
    )
);
?>
<?php if ($team_member_linkedin) { ?>
    <div <?php echo ($id_attr); ?> <?php echo ($style_attrs); ?>>
        <a href="<?php echo esc_html($team_member_linkedin); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <path d="M19.7,3H4.3C3.582,3,3,3.582,3,4.3v15.4C3,20.418,3.582,21,4.3,21h15.4c0.718,0,1.3-0.582,1.3-1.3V4.3 C21,3.582,20.418,3,19.7,3z M8.339,18.338H5.667v-8.59h2.672V18.338z M7.004,8.574c-0.857,0-1.549-0.694-1.549-1.548 c0-0.855,0.691-1.548,1.549-1.548c0.854,0,1.547,0.694,1.547,1.548C8.551,7.881,7.858,8.574,7.004,8.574z M18.339,18.338h-2.669 v-4.177c0-0.996-0.017-2.278-1.387-2.278c-1.389,0-1.601,1.086-1.601,2.206v4.249h-2.667v-8.59h2.559v1.174h0.037 c0.356-0.675,1.227-1.387,2.526-1.387c2.703,0,3.203,1.779,3.203,4.092V18.338z"></path>
            </svg>
        </a>
    </div>
<?php } ?>
<?php

/**
 * Search Toggle.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$ag_st_class_name_to_toggle = get_field('ag_st_class_name_to_toggle');
?>

<button aria-label="Open Search" class="search-toggle" data-controls="<?php echo ($ag_st_class_name_to_toggle); ?>">
    <span class="dashicons dashicons-search"></span>
</button>
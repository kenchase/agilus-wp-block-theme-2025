<?php

/**
 * Search Toggle.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$ag_st_class_name_to_toggle = get_field('ag_st_class_name_to_toggle');
?>

<div class="ag-search-toggle">
    <button aria-label="Open Search" class="ag-search-toggle-btn" data-controls="<?php echo ($ag_st_class_name_to_toggle); ?>">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="wp-block-navigation-item__label visually-hidden"><?php __('Search', 'agilus') ?></span>
    </button>
</div>
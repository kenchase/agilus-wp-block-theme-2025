<?php

/**
 * Latest Jobs Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$num_items_to_show = get_field('ag-latest-jobs-num-items');
$xml_feed_url = get_field('ag-latest-jobs-feed-url');

// Load the feed.
if ($num_items_to_show && $xml_feed_url) {
    $feed = ag_get_latest_jobs($xml_feed_url, $num_items_to_show);
} else {
    $feed = ag_get_latest_jobs();
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'ag-latest-jobs';
$background_color = '';
$text_color = '';
if (! empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
if ($background_color || $text_color) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array('background-color: ' . $background_color, 'color: ' . $text_color);
$style = implode('; ', $styles);
?>

<div class="ag-latest-jobs <?php echo esc_attr($class_name); ?>" style="<?php echo esc_attr($style); ?>">
    <?php
    if (is_array($feed)) {
        foreach ($feed['jobs'] as $job) {
            $title = $job['title'];
            $location = $job['city'] . ', ' . $job['state'];
            $type = $job['EmploymentType'];
            $date = $job['posteddate'];
            $link = 'https://en.agilus.ca/jobs/jobdetails?jobId=' . $job['JobNumber'];
            $date_obj = strtotime($date);
            $date_str = date('F j, Y', $date_obj);
    ?>
            <div class="ag-latest-jobs__item ag-clickable-card">
                <h3 class="ag-latest-jobs__title"><?php echo (esc_html($title)); ?></h3>
                <ul class="ag-latest-jobs__list">
                    <li class="ag-latest-jobs__list-item"><?php echo (esc_html($location)); ?></li>
                    <li class="ag-latest-jobs__list-item"><?php echo (esc_html($type)); ?></li>
                    <li class="ag-latest-jobs__list-item"><?php echo (esc_html($date_str)); ?></li>
                </ul>
                <a href="<?php echo ($link); ?>" class="ag-latest-jobs__link" aria-label="<?php echo (esc_html($title)); ?>">View job posting <i class=" fa-solid fa-caret-right"></i></a>
            </div>
        <?php } ?>
    <?php } ?>
</div>
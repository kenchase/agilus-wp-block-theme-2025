<?php
$short_title = get_field('ag-cs-short-title', $post_id);
$logo_id = get_field('ag-cs-logo', $post_id);
$logo = "";
if ($logo_id) {
    $logo = wp_get_attachment_image(
        $logo_id,
        'full',
        false,
    );
}
?>
<div class="ag-case-study">
    <div class="ag-case-study__card">
        <a href="#case-study-<?php echo ($post_id); ?>">
            <div class="ag-case-study__logo"><?php echo ($logo) ?></div>
            <h3 class="ag-case-study__short-title"><?php echo ($short_title); ?></h3>
        </a>
    </div>
    <div id="case-study-<?php echo ($post_id); ?>" class="ag-case-study__content visually-hidden">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>
</div>
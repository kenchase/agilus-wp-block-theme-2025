<?php
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
    <div class="ag-case-study__logo"><a href="#case-study-<?php echo ($post_id); ?>"><?php echo ($logo) ?></a></div>
    <div id="case-study-<?php echo ($post_id); ?>" class="ag-case-study__content visually-hidden">
        <h1><?php the_title(); ?></h1>
        <?php
        the_content();
        ?>
    </div>
</div>
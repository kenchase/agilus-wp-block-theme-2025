<?php
$args = array(
    'post_type' => 'ag-faq',
    'posts_per_page' => -1, // Retrieve all posts
    'orderby' => 'date',
    'order' => 'ASC'
);
$faq_query = new WP_Query($args);
?>
<?php if ($faq_query->have_posts()) { ?>
    <?php while ($faq_query->have_posts()) { ?>
        <?php $faq_query->the_post(); ?>
        <div class="ag-faq">
            <details>
                <summary>
                    <?php the_title(); ?>
                </summary>
                <div class="ag-faq-answer"><?php the_content(); ?></div>
            </details>
        </div>
    <?php } ?>
<?php } ?>
<?php
function my_theme_register_post_template_pattern()
{
    register_block_pattern(
        'my-theme/post-template-layout',
        array(
            'title' => __('Post Template Card', 'my-theme'),
            'description' => __('A clean card-style post template', 'my-theme'),
            'content' => '<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
    <!-- wp:post-featured-image {"isLink":true,"height":"300px"} /-->

    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
    <div class="wp-block-group">
        <!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->

        <!-- wp:post-date /-->

        <!-- wp:post-excerpt {"moreText":"Read More","showMoreOnNewLine":false} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->',
            'category' => 'template',
            'keywords' => array('post', 'card', 'layout')
        )
    );
}
add_action('init', 'my_theme_register_post_template_pattern');

<?php

/**
 * Title: Blog Post
 * Slug: agilus/blog-post
 * Categories: Cards
 */
?>
<!-- wp:columns {"metadata":{"name":"Blog Post","categories":["Cards"],"patternName":"agilus/blog-post"},"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
    <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:post-featured-image {"style":{"border":{"radius":"8px"}}} /--></div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"66.66%"} -->
    <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","flexWrap":"nowrap"}} -->
        <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"isLink":true} /-->

                <!-- wp:post-date {"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-600"}}}},"textColor":"neutral-600","fontSize":"small"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:post-excerpt {"moreText":"Read More","excerptLength":40} /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->
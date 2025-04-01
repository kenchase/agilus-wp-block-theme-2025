<?php
// Add custom rewrite rules for tag archives to include category
add_action('init', 'custom_tag_with_category_rewrite_rules', 10, 0);
function custom_tag_with_category_rewrite_rules()
{
    // Get all tags
    $tags = get_tags(array('hide_empty' => false));

    if (!empty($tags)) {
        foreach ($tags as $tag) {
            // For each tag, add a custom rewrite rule
            $tag_slug = $tag->slug;

            // Get posts with this tag
            $posts_with_tag = get_posts(array(
                'tag' => $tag_slug,
                'posts_per_page' => 1
            ));

            if (!empty($posts_with_tag)) {
                // Get the first post's primary category
                $post_id = $posts_with_tag[0]->ID;
                $categories = get_the_category($post_id);

                if (!empty($categories)) {
                    // Use the first category
                    $category_slug = $categories[0]->slug;

                    // Add rewrite rule
                    add_rewrite_rule(
                        '^' . $category_slug . '/tag/' . $tag_slug . '/?$',
                        'index.php?tag=' . $tag_slug,
                        'top'
                    );
                }
            }
        }
    }
}

// Filter tag links to include the category
add_filter('tag_link', 'custom_tag_permalink', 10, 2);
function custom_tag_permalink($permalink, $tag)
{
    // Get posts with this tag
    $posts_with_tag = get_posts(array(
        'tag_id' => $tag->term_id,
        'posts_per_page' => 1
    ));

    if (!empty($posts_with_tag)) {
        // Get the first post's primary category
        $post_id = $posts_with_tag[0]->ID;
        $categories = get_the_category($post_id);

        if (!empty($categories)) {
            // Use the first category
            $category_slug = $categories[0]->slug;

            // Replace the permalink
            $permalink = str_replace('tag/' . $tag->slug, $category_slug . '/tag/' . $tag->slug, $permalink);
        }
    }

    return $permalink;
}

// Flush rewrite rules upon theme activation
add_action('after_switch_theme', 'flush_rewrite_rules');

<?php

/**
 * Helper Functions
 */
/** Get Post Lists */
if (!function_exists('nobel_magazine_addons_post_lists')) {

    function nobel_magazine_addons_post_lists($multiple) {
        $posts = get_posts(array('posts_per_page' => 100));

        if ($multiple) {
            $post_list = array('all' => __('All', 'nobel-magazine-addons'));
        } else {
            $post_list = array('none' => __('None', 'nobel-magazine-addons'));
        }

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $post_list[$post->post_name] = $post->post_title;
            }
        }

        return $post_list;
    }

}

/** Orderby List */
if (!function_exists('nobel_magazine_addons_orderby_list')) {

    function nobel_magazine_addons_orderby_list() {
        return array(
            'none' => __('None', 'nobel-magazine-addons'),
            'date' => __('Date', 'nobel-magazine-addons'),
            'title' => __('Title', 'nobel-magazine-addons'),
            'name' => __('Name', 'nobel-magazine-addons'),
            'ID' => __('ID', 'nobel-magazine-addons'),
        );
    }

}

/** Order List */
if (!function_exists('nobel_magazine_addons_order_list')) {

    function nobel_magazine_addons_order_list() {
        return array(
            'ASC' => __('Ascending', 'nobel-magazine-addons'),
            'DESC' => __('Descending', 'nobel-magazine-addons'),
        );
    }

}

/** Image Sizes List */
if (!function_exists('nobel_magazine_addons_imagesizes_list')) {

    function nobel_magazine_addons_imagesizes_list() {
        global $_wp_additional_image_sizes;

        $default_image_sizes = get_intermediate_image_sizes();
        $image_size_list = array();

        foreach ($default_image_sizes as $size) {
            $image_sizes[$size]['width'] = intval(get_option("{$size}_size_w"));
            $image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
            $image_sizes[$size]['crop'] = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
        }

        if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes)) {
            $image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);
        }
        foreach ($image_sizes as $key => $value) {
            $image_size_list[$key] = ucfirst($key);
        }
        return $image_size_list;
    }

}

// Get all Authors
if (!function_exists('nobel_magazine_addons_get_auhtors')) {

    function nobel_magazine_addons_get_auhtors() {

        $options = array();

        $users = get_users();

        foreach ($users as $user) {
            $options[$user->ID] = $user->display_name;
        }

        return $options;
    }

}

/** Get Attachment Alt Tag */
if (!function_exists('nobel_magazine_addons_get_altofimage')) {

    function nobel_magazine_addons_get_altofimage($attachment) {
        $attachment_id = '';
        if ($attachment) {
            if (is_string($attachment)) {
                $attachment_id = attachment_url_to_postid($attachment);
            } elseif (is_int($attachment)) {
                $attachment_id = $attachment;
            }
            return get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        }
    }

}

/** Get Image */
if (!function_exists('nobel_magazine_addons_image')) {

    function nobel_magazine_addons_image($image_size = 'full', $display_category = false) {
        echo '<div class="nma-post-thumb">';
        echo '<a href="' . esc_url(get_the_permalink()) . '">';
        echo '<div class="nma-post-thumb-container">';
        the_post_thumbnail($image_size);
        echo '</div>';
        echo '</a>';
        if ($display_category == 'all') {
            nobel_magazine_addons_all_category();
        } elseif ($display_category == 'primary') {
            nobel_magazine_addons_primary_category();
        }
        echo '</div>';
    }

}

/** Get All Authors */
if (!function_exists('nobel_magazine_addons_author_name')) {

    function nobel_magazine_addons_author_name() {
        echo '<span><i class="ti-pencil"></i>' . get_the_author() . '</span>';
    }

}

/** Get Comment Count */
if (!function_exists('nobel_magazine_addons_comment_count')) {

    function nobel_magazine_addons_comment_count() {
        echo '<span><i class="ti-comment"></i>' . get_comments_number() . '</span>';
    }

}

if (!function_exists('nobel_magazine_addons_post_date')) {

    function nobel_magazine_addons_post_date($format = '') {
        if ($format) {
            echo '<span><i class="ti-time"></i>' . get_the_date($format) . '</span>';
        } else {
            echo '<span><i class="ti-time"></i>' . get_the_date() . '</span>';
        }
    }

}


if (!function_exists('nobel_magazine_addons_time_ago')) {

    function nobel_magazine_addons_time_ago() {
        echo '<span><i class="ti-time"></i>' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'nobel-magazine-addons') . '</span>';
    }

}

// Custom Excerpt
if (!function_exists('nobel_magazine_addons_custom_excerpt')) {

    function nobel_magazine_addons_custom_excerpt($limit) {
        if ($limit) {
            $content = get_the_content();
            $content = strip_tags($content);
            $content = strip_shortcodes($content);
            $excerpt = mb_substr($content, 0, $limit);

            if (strlen($content) >= $limit) {
                $excerpt = $excerpt . '...';
            }

            echo $excerpt;
        }
    }

}

/** Get All Posts */
if (!function_exists('nobel_magazine_addons_get_posts')) {

    function nobel_magazine_addons_get_posts() {

        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

}

/** Get All Categories */
if (!function_exists('nobel_magazine_addons_get_categories')) {

    function nobel_magazine_addons_get_categories() {
        $cats = array();

        $terms = get_categories(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $cats[$term->term_id] = $term->name;
        }

        return $cats;
    }

}

/** Get All Tags */
if (!function_exists('nobel_magazine_addons_get_tags')) {

    function nobel_magazine_addons_get_tags() {
        $tags = array();

        $terms = get_tags(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $tags[$term->term_id] = $term->name;
        }

        return $tags;
    }

}

if (!function_exists('nobel_magazine_addons_primary_category')) {

    function nobel_magazine_addons_primary_category($class = "nma-primary-category") {
        $post_categories = nobel_magazine_addons_get_category(get_the_ID());

        if (!empty($post_categories)) {
            $category_obj = $post_categories['primary_category'];
            $category_link = get_category_link($category_obj->term_id);
            echo '<div class="' . esc_attr($class) . '">';
            echo '<a class="nma-category nma-category-' . esc_attr($category_obj->term_id) . '" href="' . esc_url($category_link) . '">' . esc_html($category_obj->name) . '</a>';
            echo '</div>';
        }
    }

}

if (!function_exists('nobel_magazine_addons_all_category')) {

    function nobel_magazine_addons_all_category() {
        $post_categories = nobel_magazine_addons_get_category(get_the_ID(), 'category', true);

        if (!empty($post_categories)) {
            echo '<div class="nma-category-list">';
            $category_ids = $post_categories['all_categories'];
            foreach ($category_ids as $category_id) {
                echo '<a class="nma-category nma-category-' . esc_attr($category_id) . '" href="' . esc_url(get_category_link($category_id)) . '">' . esc_html(get_cat_name($category_id)) . '</a>';
            }
            echo '</div>';
        }
    }

}

if (!function_exists('nobel_magazine_addons_get_category')) {

    function nobel_magazine_addons_get_category($post_id, $term = 'category', $return_all_categories = false) {
        $return = array();

        if (class_exists('WPSEO_Primary_Term')) {
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
            $primary_term = get_term($wpseo_primary_term->get_primary_term());

            if (!is_wp_error($primary_term)) {
                $return['primary_category'] = $primary_term;
            }
        }

        if (empty($return['primary_category']) || $return_all_categories) {
            $categories_list = get_the_terms($post_id, $term);

            if (empty($return['primary_category']) && !empty($categories_list)) {
                $return['primary_category'] = $categories_list[0];  //get the first category
            }

            if ($return_all_categories) {
                $return['all_categories'] = array();

                if (!empty($categories_list)) {
                    foreach ($categories_list as &$category) {
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }

        return $return;
    }

}
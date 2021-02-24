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
        echo '<span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 288.4c-153.8 0-238.6 72.8-238.6 204.9 0 10.3 8.4 18.7 18.7 18.7h439.7c10.3 0 18.7-8.4 18.7-18.7C494.6 361.2 409.8 288.4 256 288.4zM55.5 474.6c7.4-98.8 74.7-148.9 200.5-148.9s193.2 50.1 200.5 148.9H55.5z"/><path d="M256 0c-70.7 0-124 54.4-124 126.4 0 74.2 55.6 134.5 124 134.5s124-60.3 124-134.5C380 54.4 326.7 0 256 0zM256 223.6c-47.7 0-86.6-43.6-86.6-97.2 0-51.6 36.4-89.1 86.6-89.1 49.4 0 86.6 38.3 86.6 89.1C342.6 180 303.7 223.6 256 223.6z"/></svg>' . get_the_author() . '</span>';
    }

}

/** Get Comment Count */
if (!function_exists('nobel_magazine_addons_comment_count')) {

    function nobel_magazine_addons_comment_count() {
        echo '<span><svg xmlns="http://www.w3.org/2000/svg" height="" viewBox="0 0 511.1 511.1" width="512"><path d="m74.4 480.5h-36.2l25.6-25.6c13.8-13.8 22.4-31.8 24.7-51.2-36-23.6-62.4-54.8-76.5-90.4-14.1-35.6-15.9-74.9-5.1-113.5 12.9-46.3 43.1-88.5 85.1-118.9 45.6-33 102.5-50.4 164.3-50.4 77.9 0 143.6 22.4 189.9 64.7 41.7 38.2 64.7 89.6 64.7 144.9 0 26.9-5.5 53-16.3 77.7-11.2 25.6-27.5 48.3-48.6 67.6-46.4 42.5-112 65-189.8 65-28.9 0-59-3.9-85.9-10.9-25.5 26.1-60 40.9-96.1 40.9zm182-420c-124 0-200.1 74-220.6 147.3-19.3 69.3 9.1 134.7 76 175.1l7.5 4.5-0.2 8.7c-0.5 17.3-4.6 33.9-11.9 49 17.9-6.1 34.2-17.1 47-32.2l6.3-7.5 9.4 2.8c26.4 7.9 57.1 12.2 86.5 12.2 154.4 0 224.7-93.5 224.7-180.3 0-46.8-19.5-90.4-55-122.8-40.7-37.2-99.4-56.9-169.7-56.9z"/></svg>' . get_comments_number() . '</span>';
    }

}

if (!function_exists('nobel_magazine_addons_post_date')) {

    function nobel_magazine_addons_post_date($format = '') {
        if ($format) {
            echo '<span><svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm-380 32h46v16c0 8.836 7.163 16 16 16s16-7.164 16-16v-16h224v16c0 8.836 7.163 16 16 16s16-7.164 16-16v-16h46c18.748 0 34 15.252 34 34v38h-448v-38c0-18.748 15.252-34 34-34zm380 408h-380c-18.748 0-34-15.252-34-34v-270h448v270c0 18.748-15.252 34-34 34z"/></g></svg>' . get_the_date($format) . '</span>';
        } else {
            echo '<span><svg xmlns="http://www.w3.org/2000/svg" height="" viewBox="0 0 512 512" width="512"><path d="m446 40h-46v-24c0-8.8-7.2-16-16-16s-16 7.2-16 16v24h-224v-24c0-8.8-7.2-16-16-16s-16 7.2-16 16v24h-46c-36.4 0-66 29.6-66 66v340c0 36.4 29.6 66 66 66h380c36.4 0 66-29.6 66-66v-340c0-36.4-29.6-66-66-66zm-380 32h46v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16h224v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16h46c18.7 0 34 15.3 34 34v38h-448v-38c0-18.7 15.3-34 34-34zm380 408h-380c-18.7 0-34-15.3-34-34v-270h448v270c0 18.7-15.3 34-34 34z"/></svg>' . get_the_date() . '</span>';
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
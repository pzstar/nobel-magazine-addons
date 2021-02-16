<?php

namespace NobelMagazineAddons\Modules\BlockOne\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use NobelMagazineAddons\Group_Control_Query;
use NobelMagazineAddons\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Block_One extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'nma-news-block-one';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('News Block One', 'nobel-magazine-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'nma-elements nma-block-one';
    }

    /** Category */
    public function get_categories() {
        return ['nobel-magazine-addons'];
    }

    /** Controls */
    protected function _register_controls() {
        $this->start_controls_section(
                'header', [
            'label' => esc_html__('Header', 'nobel-magazine-addons'),
                ]
        );

        $this->add_group_control(
                Group_Control_Header::get_type(), [
            'name' => 'header',
            'label' => esc_html__('Header', 'nobel-magazine-addons'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_query', [
            'label' => esc_html__('Content Filter', 'nobel-magazine-addons'),
                ]
        );

        $this->add_group_control(
                Group_Control_Query::get_type(), [
            'name' => 'posts',
            'label' => esc_html__('Posts', 'nobel-magazine-addons'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_featured_block', [
            'label' => esc_html__('Featured Block', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control(
                'featured_post_count', [
            'label' => esc_html__('No of Posts', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 5,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'separator' => 'after'
                ]
        );


        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'featured_post_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'featured_thumb_height', [
            'label' => esc_html__('Image Height (%)', 'plugin-name'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 30,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-left-block .nma-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control('featured_excerpt_length', [
            'label' => esc_html__('Excerpt Length (in Letters)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 250,
            'description' => esc_html__('Leave blank or enter 0 to hide the excerpt', 'nobel-magazine-addons'),
        ]);

        $this->add_control(
                'featured_post_author', [
            'label' => esc_html__('Post Author', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'separator' => 'before',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'featured_post_date', [
            'label' => esc_html__('Post Date', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'featured_post_comment', [
            'label' => esc_html__('Post Comments', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_listing_block', [
            'label' => esc_html__('Listing Block', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control(
                'listing_post_count', [
            'label' => esc_html__('No of Posts', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 4,
            ],
            'separator' => 'after'
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'list_post_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'listing_thumb_position', [
            'label' => esc_html__('Thumbnail Position', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', 'nobel-magazine-addons'),
                'right' => esc_html__('Right', 'nobel-magazine-addons'),
            ],
            'default' => 'left'
                ]
        );

        $this->add_control(
                'listing_thumb_width', [
            'label' => esc_html__('Image Width(px)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 30,
                    'max' => 300,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 120,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-right-block .nma-post-list .nma-post-thumb' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'listing_thumb_height', [
            'label' => esc_html__('Image Height (%)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 30,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-right-block .nma-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control('listing_excerpt_length', [
            'label' => esc_html__('Excerpt Length (in Letters)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 0,
            'description' => esc_html__('Leave blank or enter 0 to hide the excerpt', 'nobel-magazine-addons'),
        ]);

        $this->add_control(
                'listing_post_author', [
            'label' => esc_html__('Post Author', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'listing_post_date', [
            'label' => esc_html__('Post Date', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'listing_post_comment', [
            'label' => esc_html__('Post Comments', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'additional_settings', [
            'label' => esc_html__('Additional Settings', 'nobel-magazine-addons'),
                ]
        );

        $this->add_responsive_control(
                'layout_col', [
            'label' => esc_html__('No of Columns', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 3,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'listing_post_count_tablet', [
            'label' => esc_html__('No of Listing Post to Display in Tablet', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'conditions' => [
                'relation' => 'and',
                'terms' => [
                    [
                        'name' => 'layout_col[size]',
                        'operator' => '==',
                        'value' => 3
                    ],
                    [
                        'name' => 'layout_col_tablet[size]',
                        'operator' => '==',
                        'value' => 2
                    ]
                ]
            ],
                ]
        );

        $this->add_control(
                'date_format', [
            'label' => esc_html__('Date Format', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'relative_format' => esc_html__('Relative Format (Ago)', 'nobel-magazine-addons'),
                'default' => esc_html__('WordPress Default Format', 'nobel-magazine-addons'),
                'custom' => esc_html__('Custom Format', 'nobel-magazine-addons'),
            ],
            'default' => 'default',
            'separator' => 'before',
            'label_block' => true
                ]
        );

        $this->add_control(
                'custom_date_format', [
            'label' => esc_html__('Custom Date Format', 'nobel-magazine-addons'),
            'type' => Controls_Manager::TEXT,
            'default' => 'F j, Y',
            'placeholder' => esc_html__('F j, Y', 'nobel-magazine-addons'),
            'condition' => [
                'date_format' => 'custom'
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'heading_style', [
            'label' => esc_html__('Heading Text', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'heading_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-block1 .nobel-magazine-post-main-header, {{WRAPPER}} .nma-post-block1 .nobel-magazine-post-main-header a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-block1 .nobel-magazine-post-main-header, {{WRAPPER}} .nma-post-block1 .nobel-magazine-post-main-header a',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'featured_title_style', [
            'label' => esc_html__('Featured Block Title', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'featured_title_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-left-block h3.nma-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'featured_title_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-left-block h3.nma-post-title',
                ]
        );

        $this->add_control(
                'featured_title_margin', [
            'label' => esc_html__('Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-left-block h3.nma-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'list_title_style', [
            'label' => esc_html__('Listing Block Title', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'list_title_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-right-block h3.nma-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'list_title_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-right-block h3.nma-post-title a',
                ]
        );

        $this->add_control(
                'list_title_margin', [
            'label' => esc_html__('Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-right-block h3.nma-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'excerpt_style', [
            'label' => esc_html__('Post Excerpt', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-excerpt',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_metas', [
            'label' => esc_html__('Post Metas', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_metas_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-meta span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'post_metas_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-meta span',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $featured_post_count = $settings['featured_post_count']['size'];
        $listing_post_count = $settings['listing_post_count']['size'];
        $listing_thumb_position = $settings['listing_thumb_position'];
        $listing_post_count_tablet = $settings['listing_post_count_tablet']['size'] ? $settings['listing_post_count_tablet']['size'] : $listing_post_count;
        $hide_after_post_count = (int) $featured_post_count + (int) $listing_post_count_tablet;

        $this->add_render_attribute('nma-post-block-one', 'class', [
            'nma-post-block-one',
            'nma-pbo-col-' . $settings['layout_col']['size'],
            'nma-pbo-tablet-col-' . $settings['layout_col_tablet']['size'],
            'nma-pbo-mobile-col-' . $settings['layout_col_mobile']['size']
                ]
        );
        ?>
        <div class="nma-post-block">

            <?php $this->render_header(); ?>

            <?php
            $args = $this->query_args();
            $post_query = new \WP_Query($args);
            $counter = 1;
            ?>

            <?php if ($post_query->have_posts()) { ?>
                <div <?php echo $this->get_render_attribute_string('nma-post-block-one'); ?>>
                    <?php
                    while ($post_query->have_posts()) {
                        $post_query->the_post();
                        $current_post_count = $post_query->current_post + 1;
                        $total_post_count = $post_query->post_count;
                        $image_size = ( $current_post_count <= $featured_post_count ) ? $settings['featured_post_image_size'] : $settings['list_post_image_size'];
                        $title_class = ( $current_post_count <= $featured_post_count ) ? ' nma-big-title' : '';
                        $post_list_class = $current_post_count > $hide_after_post_count ? 'nma-tablet-hide' : '';
                        ?>
                        <?php if ($current_post_count == 1) { ?>
                            <div class="nma-left-block">
                            <?php }; ?>

                            <div class="nma-post-list <?php echo esc_attr($post_list_class); ?>">
                                <?php nobel_magazine_addons_image($image_size); ?>

                                <div class="nma-post-content">

                                    <h3 class="nma-post-title<?php echo esc_attr($title_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>

                                    <?php $this->get_post_meta($current_post_count); ?>

                                    <?php $this->get_post_excerpt($current_post_count); ?>
                                </div>
                            </div>

                            <?php if (($total_post_count < $featured_post_count && $total_post_count == $current_post_count) || $current_post_count == $featured_post_count) { ?>
                            </div>

                            <?php if ($total_post_count > $featured_post_count) { ?>
                                <div class="nma-right-block nma-thumb-position-<?php echo esc_attr($listing_thumb_position); ?>">
                                    <div class="nma-right-block-wrap">
                                        <?php
                                    }
                                }
                                ?>

                                <?php if ($total_post_count > $featured_post_count && $total_post_count == $current_post_count) { ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $counter++;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }

    /** Render Header */
    protected function render_header() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('header_attr', 'class', [
            'nobel-magazine-block-header',
            $settings['header_style'],
            $settings['header_alignment']
                ]
        );

        $link_open = $link_close = "";
        $target = $settings['header_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['header_link']['nofollow'] ? ' rel="nofollow"' : '';

        if ($settings['header_link']['url']) {
            $link_open = '<a href="' . $settings['header_link']['url'] . '"' . $target . $nofollow . '>';
            $link_close = '</a>';
        }

        if ($settings['header_title']) {
            ?>
            <h5 <?php echo $this->get_render_attribute_string('header_attr'); ?>>
                <?php
                echo $link_open;
                echo $settings['header_title'];
                echo $link_close;
                ?>
            </h5>
            <?php
        }
    }

    /** Query Args */
    protected function query_args() {
        $settings = $this->get_settings_for_display();

        $post_type = $args['post_type'] = $settings['posts_post_type'];
        $args['orderby'] = $settings['posts_orderby'];
        $args['order'] = $settings['posts_order'];
        $args['ignore_sticky_posts'] = 1;
        $args['post_status'] = 'publish';
        $args['offset'] = $settings['posts_offset'];
        $args['posts_per_page'] = (int) $settings['listing_post_count']['size'] + (int) $settings['featured_post_count']['size'];
        $args['post__not_in'] = $post_type == 'post' ? $settings['posts_exclude_posts'] : [];

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $object) {
            $setting_key = 'posts_' . $object->name . '_ids';

            if (!empty($settings[$setting_key])) {
                $args['tax_query'][] = [
                    'taxonomy' => $object->name,
                    'field' => 'term_id',
                    'terms' => $settings[$setting_key],
                ];
            }
        }

        return $args;
    }

    /** Get Post Excerpt */
    protected function get_post_excerpt($count) {
        $settings = $this->get_settings_for_display();
        $featured_post_count = $settings['featured_post_count']['size'];

        $excerpt_length = $count <= $featured_post_count ? $settings['featured_excerpt_length'] : $settings['listing_excerpt_length'];
        if ($excerpt_length) {
            ?>
            <div class="nma-post-excerpt"><?php echo nobel_magazine_addons_custom_excerpt($excerpt_length); ?></div>
            <?php
        }
    }

    /** Get Post Metas */
    protected function get_post_meta($count) {
        $settings = $this->get_settings_for_display();
        $featured_post_count = $settings['featured_post_count']['size'];
        $post_author = $count <= $featured_post_count ? $settings['featured_post_author'] : $settings['listing_post_author'];
        $post_date = $count <= $featured_post_count ? $settings['featured_post_date'] : $settings['listing_post_date'];
        $post_comment = $count <= $featured_post_count ? $settings['featured_post_comment'] : $settings['listing_post_comment'];

        if ($post_author == 'yes' || $post_date == 'yes' || $post_comment == 'yes') {
            ?>
            <div class="nma-post-meta">
                <?php
                if ($post_author == 'yes') {
                    nobel_magazine_addons_author_name();
                }

                if ($post_date == 'yes') {
                    $date_format = $settings['date_format'];

                    if ($date_format == 'relative_format') {
                        nobel_magazine_addons_time_ago();
                    } else if ($date_format == 'default') {
                        nobel_magazine_addons_post_date();
                    } else if ($date_format == 'custom') {
                        $format = $settings['custom_date_format'];
                        nobel_magazine_addons_post_date($format);
                    }
                }

                if ($post_comment == 'yes') {
                    nobel_magazine_addons_comment_count();
                }
                ?>
            </div>
            <?php
        }
    }

}

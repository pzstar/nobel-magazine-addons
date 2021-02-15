<?php

namespace NobelMagazineAddons\Modules\CarouselOne\Widgets;

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
class Carousel_One extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'nma-news-carousel-one';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('News Carousel One', 'nobel-magazine-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'nma-elements nma-carousel-one';
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

        $this->add_control(
                'no_of_posts', [
            'label' => esc_html__('No of Posts', 'nobel-magazine-addons'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 50,
            'default' => 5,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_meta', [
            'label' => esc_html__('Post Meta', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control(
                'post_author', [
            'label' => esc_html__('Post Author', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'post_date', [
            'label' => esc_html__('Post Date', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'post_comment', [
            'label' => esc_html__('Post Comments', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
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
            'label_block' => true,
            'condition' => [
                'post_date' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'custom_date_format', [
            'label' => esc_html__('Custom Date Format', 'nobel-magazine-addons'),
            'type' => Controls_Manager::TEXT,
            'default' => 'F j, Y',
            'placeholder' => esc_html__('F j, Y', 'nobel-magazine-addons'),
            'condition' => [
                'date_format' => 'custom',
                'post_date' => 'yes'
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_excerpt', [
            'label' => esc_html__('Post Excerpt', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control('excerpt_length', [
            'label' => esc_html__('Excerpt Length (in Letters)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 100,
            'description' => esc_html__('Leave blank or enter 0 to hide the excerpt', 'nobel-magazine-addons'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_section', [
            'label' => esc_html__('Carousel Settings', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => esc_html__('Autoplay', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'nobel-magazine-addons'),
            'label_off' => esc_html__('No', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_duration', [
            'label' => esc_html__('Pause Duration', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 's',
                'size' => 5,
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_responsive_control(
                'no_of_slides', [
            'label' => esc_html__('No of Slides', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_stagepadding', [
            'label' => esc_html__('Stage Padding', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'nav', [
            'label' => esc_html__('Nav Arrow', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'nobel-magazine-addons'),
            'label_off' => esc_html__('Hide', 'nobel-magazine-addons'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'dots', [
            'label' => esc_html__('Nav Dots', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'nobel-magazine-addons'),
            'label_off' => esc_html__('Hide', 'nobel-magazine-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_image', [
            'label' => esc_html__('Image Settings', 'nobel-magazine-addons'),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'slide_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'image_height', [
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
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-image .nma-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'content_alignment', [
            'label' => esc_html__('Content Alignment', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', 'nobel-magazine-addons'),
                'center' => esc_html__('Center', 'nobel-magazine-addons'),
                'right' => esc_html__('Right', 'nobel-magazine-addons'),
            ],
            'default' => 'left'
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
                '{{WRAPPER}} .nma-post-slider h5, {{WRAPPER}} .nma-post-slider h5 a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-slider h5,{{WRAPPER}} .nma-post-slider h5 a',
                ]
        );

        $this->add_control(
                'heading_margin', [
            'label' => esc_html__('Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-post-slider h5' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Post Title', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-title a',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} h3.nma-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .nma-post-content .nma-post-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-content .nma-post-excerpt',
                ]
        );

        $this->add_control(
                'excerpt_margin', [
            'label' => esc_html__('Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-post-content .nma-post-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'meta_style', [
            'label' => esc_html__('Post Metas', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'meta_color', [
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
            'name' => 'meta_typography',
            'label' => esc_html__('Typography', 'nobel-magazine-addons'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nma-post-meta span',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation', 'nobel-magazine-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'style_tabs'
        );

        $this->start_controls_tab(
                'style_normal_tab', [
            'label' => esc_html__('Normal', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control(
                'nav_bg_color', [
            'label' => esc_html__('Button Background Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_color', [
            'label' => esc_html__('Button Icon Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color', [
            'label' => esc_html__('Dots Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'style_hover_tab', [
            'label' => esc_html__('Hover', 'nobel-magazine-addons'),
                ]
        );

        $this->add_control(
                'nav_bg_color_hover', [
            'label' => esc_html__('Button Background Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_color_hover', [
            'label' => esc_html__('Button Icon Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color_hover', [
            'label' => esc_html__('Dots Color', 'nobel-magazine-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_size = $settings['slide_image_size'];
        $content_alignment = $settings['content_alignment'];
        $args = $this->query_args();
        $post_query = new \WP_Query($args);

        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'items' => (int) $settings['no_of_slides']['size'],
            'items_tablet' => (int) $settings['no_of_slides_tablet']['size'],
            'items_mobile' => (int) $settings['no_of_slides_mobile']['size'],
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) $settings['slides_margin_tablet']['size'],
            'margin_mobile' => (int) $settings['slides_margin_mobile']['size'],
            'stagepadding' => (int) $settings['slides_stagepadding']['size'],
            'stagepadding_tablet' => (int) $settings['slides_stagepadding_tablet']['size'],
            'stagepadding_mobile' => (int) $settings['slides_stagepadding_mobile']['size'],
            'nav' => $settings['nav'] == 'yes' ? true : false,
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="nma-post-carousel-block">
            <!-- Heading -->
            <?php $this->render_header(); ?>

            <!-- Post Lists -->
            <?php if ($post_query->have_posts()) : ?>
                <div class="nma-post-carousel-one owl-carousel" data-params='<?php echo $params; ?>'>
                    <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                        <div class="nma-post-slides">
                            <div class="nma-post-image">
                                <?php nobel_magazine_addons_image($image_size); ?>
                            </div>

                            <div class="nma-post-content nma-align-<?php echo esc_attr($content_alignment); ?>">
                                <?php $this->get_post_title(); ?>
                                <?php $this->get_post_meta(); ?>
                                <?php $this->get_post_excerpt(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <?php
    }

    /** Render Header */
    protected function render_header() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('header_attr', 'class', [
            'nobel-magazine-post-main-header',
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
        $args['posts_per_page'] = $settings['no_of_posts'];
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

    /** Get Post Title */
    protected function get_post_title() {
        ?>
        <h3 class="nma-post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
        <?php
    }

    /** Get Post Excerpt */
    protected function get_post_excerpt() {
        $settings = $this->get_settings_for_display();
        $length = $settings['excerpt_length'];
        if ($length) {
            ?>
            <div class="nma-post-excerpt"><?php echo nobel_magazine_addons_custom_excerpt($length); ?></div>
            <?php
        }
    }

    /** Get Post Metas */
    protected function get_post_meta() {
        $settings = $this->get_settings_for_display();
        $post_author = $settings['post_author'];
        $post_date = $settings['post_date'];
        $post_comment = $settings['post_comment'];

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

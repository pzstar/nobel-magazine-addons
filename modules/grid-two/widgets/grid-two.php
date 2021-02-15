<?php

namespace NobelMagazineAddons\Modules\GridTwo\Widgets;

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
class Grid_Two extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'nma-news-grid-two';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('News Grid Two', 'nobel-magazine-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'nma-elements nma-grid-two';
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
                'image_spacing', [
            'label' => esc_html__('Spacing Between Image (px)', 'nobel-magazine-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 5
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 30,
            ],
            'selectors' => [
                '{{WRAPPER}} .nma-post-grid-two' => 'gap: {{SIZE}}{{UNIT}};',
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
        
        $this->add_control(
                'content_padding', [
            'label' => esc_html__('Content Padding', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-post-graident-title .nma-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );
        
        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Content Margin', 'nobel-magazine-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .nma-post-graident-title .nma-post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'overlay_background_section', [
            'label' => esc_html__('Overlay Background', 'nobel-magazine-addons'),
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(), [
            'name' => 'background',
            'label' => __('Overlay Background', 'nobel-magazine-addons'),
            'types' => ['gradient'],
            'selector' => '{{WRAPPER}} .nma-post-graident-title .nma-post-content',
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
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_size = $settings['slide_image_size'];
        $content_alignment = $settings['content_alignment'];
        $args = $this->query_args();
        $post_query = new \WP_Query($args);
        ?>
        <div class="nma-post-grid-block">
            <!-- Heading -->
            <?php $this->render_header(); ?>

            <!-- Post Lists -->
            <?php if ($post_query->have_posts()) : ?>
                <div class="nma-post-grid-two">
                    <?php
                    while ($post_query->have_posts()) : $post_query->the_post();
                        $count = $post_query->current_post + 1;
                        ?>
                        <div class="nma-post nma-post-<?php echo $count; ?>">
                            <div class="nma-post-image nma-post-graident-title">
                                <?php nobel_magazine_addons_image($image_size); ?>
                                <div class="nma-post-content nma-align-<?php echo esc_attr($content_alignment); ?>">
                                    <?php $this->get_post_title(); ?>
                                    <?php $this->get_post_meta(); ?>
                                </div>
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
        $args['posts_per_page'] = 4;
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

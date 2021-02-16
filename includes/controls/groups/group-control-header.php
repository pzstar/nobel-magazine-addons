<?php

namespace NobelMagazineAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Header extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'nobel-magazine-addons-header';
    }

    protected function init_fields() {
        $fields = [];

        $fields['title'] = [
            'label' => __('Title', 'nobel-magazine-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true
        ];

        $fields['link'] = [
            'label' => __('Link', 'nobel-magazine-addons'),
            'type' => Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => false,
                'nofollow' => true,
            ],
        ];

        $fields['style'] = [
            'label' => __('Header Style', 'nobel-magazine-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'nma-style-1' => [
                    'title' => __('Style 1', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-left',
                ],
                'nma-style-2' => [
                    'title' => __('Style 2', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-center',
                ],
                'nma-style-3' => [
                    'title' => __('Style 3', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-right',
                ],
                'nma-style-4' => [
                    'title' => __('Style 4', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-left',
                ],
                'nma-style-5' => [
                    'title' => __('Style 5', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-center',
                ],
                'nma-style-6' => [
                    'title' => __('Style 6', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'default' => 'nma-style-1',
            'toggle' => true,
        ];

        $fields['alignment'] = [
            'label' => __('Alignment', 'nobel-magazine-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'nma-left' => [
                    'title' => __('Left', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-left',
                ],
                'nma-center' => [
                    'title' => __('Center', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-center',
                ],
                'nma-right' => [
                    'title' => __('Right', 'nobel-magazine-addons'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'default' => 'nma-left',
            'toggle' => true,
        ];

        return $fields;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}

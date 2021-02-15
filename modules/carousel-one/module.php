<?php

namespace NobelMagazineAddons\Modules\CarouselOne;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-carousel-one';
    }

    public function get_widgets() {
        $widgets = [
            'Carousel_One',
        ];
        return $widgets;
    }

}

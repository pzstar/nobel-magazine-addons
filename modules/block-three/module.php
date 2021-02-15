<?php

namespace NobelMagazineAddons\Modules\BlockThree;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-block-three';
    }

    public function get_widgets() {
        $widgets = [
            'Block_Three',
        ];
        return $widgets;
    }

}

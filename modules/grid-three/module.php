<?php

namespace NobelMagazineAddons\Modules\GridThree;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-grid-three';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Three',
        ];
        return $widgets;
    }

}

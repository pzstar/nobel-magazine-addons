<?php

namespace NobelMagazineAddons\Modules\SingleNewsThree;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-single-bews-three';
    }

    public function get_widgets() {
        $widgets = [
            'Single_News_Three',
        ];
        return $widgets;
    }

}

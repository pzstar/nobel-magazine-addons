<?php

namespace NobelMagazineAddons\Modules\GridFour;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-post-grid-four';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Four',
        ];
        return $widgets;
    }

}

<?php

namespace NobelMagazineAddons\Modules\GridTwo;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-grid-two';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Two',
        ];
        return $widgets;
    }

}

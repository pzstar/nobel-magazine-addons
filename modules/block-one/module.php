<?php

namespace NobelMagazineAddons\Modules\BlockOne;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-block-one';
    }

    public function get_widgets() {
        $widgets = [
            'Block_One',
        ];
        return $widgets;
    }

}

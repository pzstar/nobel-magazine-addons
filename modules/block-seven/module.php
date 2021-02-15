<?php

namespace NobelMagazineAddons\Modules\BlockSeven;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-block-seven';
    }

    public function get_widgets() {
        $widgets = [
            'Block_Seven',
        ];
        return $widgets;
    }

}

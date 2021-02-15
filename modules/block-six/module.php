<?php

namespace NobelMagazineAddons\Modules\BlockSix;

use NobelMagazineAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nma-news-block-six';
    }

    public function get_widgets() {
        $widgets = [
            'Block_Six',
        ];
        return $widgets;
    }

}

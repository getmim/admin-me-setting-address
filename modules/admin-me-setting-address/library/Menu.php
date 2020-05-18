<?php
/**
 * Menu
 * @package admin-me-setting-address
 * @version 0.0.1
 */

namespace AdminMeSettingAddress\Library;


class Menu
    implements 
        \AdminMeSetting\Iface\Menus
{

    static function getMenus(): array {
        return [
            (object)[
                'label' => 'Address',
                'route' => ['adminMeSettingAddress', [], []],
                'index' => 3000
            ]
        ];
    }
}
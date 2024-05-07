<?php

namespace App\Utils;

use Lavary\Menu\Facade as Menu;

class MenuGenerator
{
    public static function generateMenu()
    {
        // documentation https://github.com/lavary/laravel-menu
        $menu = Menu::make('side_menu', function ($menu) {
            $menu->add('Dashboard', route('admin.dashboard.index'))
                ->data('prefix_route_name', 'admin.dashboard.')
                ->data('icon', 'si si-speedometer');

            // Pengaturan User Start <<<<<
            // add parent menu
            $menu
                ->add('Pengaturan User')
                ->nickname('pengaturan_user')
                ->data('prefix_route_name', 'admin.user_config.')
                ->data('icon', 'fa fa-user-cog');
            // add sub menu
            $menu
                ->pengaturan_user
                ->add('Perizinan', route('admin.user_config.role.index'))
                ->data('prefix_route_name', 'admin.user_config.role.')
                ->data('permission', 'view user_config.role');
            // add sub menu
            $menu
                ->pengaturan_user
                ->add('User', route('admin.user_config.user.index'))
                ->data('prefix_route_name', 'admin.user_config.user.')
                ->data('permission', 'view user_config.user');
            // Pengaturan User End <<<<<

        })->filter(function ($item) {
            if ($item->hasParent()) {
                $delete_if_all_false = $item->parent()->data('delete_if_all_false') ?? [];
            }
            if ($item->data('permission') == null || auth()->user()->can($item->data('permission'))) {
                if ($item->hasParent()) {
                    array_push($delete_if_all_false, true);
                    $item->parent()->data('delete_if_all_false', $delete_if_all_false);
                }
                return true;
            }
            if ($item->hasParent()) {
                array_push($delete_if_all_false, false);
                $item->parent()->data('delete_if_all_false', $delete_if_all_false);
            }
            return false;
        })->filter(function ($item) {
            $delete_if_all_false = $item->data('delete_if_all_false') ?? [true];
            if (in_array(true, $delete_if_all_false)) {
                return true;
            }
            return false;
        });

        return $menu->roots();
    }
}

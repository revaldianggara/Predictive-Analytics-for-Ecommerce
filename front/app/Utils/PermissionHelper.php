<?php

namespace App\Utils;

class PermissionHelper
{
    const SPECIAL_PERMISSIONS = [
        // name => description
        'Super-Admin' => 'Bypass all permissions, for Administrators only',
    ];

    const ACTIONS = [
        'view', 'create', 'update', 'delete'
    ];
    /**
     * Permission rule:
     *
     * 1. you can set to string, but the action will use the default actions
     * 2. you can set to array with 3 following keys:
     *  2.a. name (mandatory) => The name of the permission, this will stored in database. Use this for middleware
     *  2.b. alias (optional) => The display name of permission in permission page
     *  2.c. actions (optional) => The actions for this permission. If not set, will use default actions
     *  2.d. description (optional) => The description of this permission
     */
    const PERMISSIONS = [
        // ini contoh
        // 'master' => [
        //     [
        //         'name' => 'master_apagitu'
        //     ]
        // ]
    ];


    public static function getPermission()
    {
        $permissions = self::PERMISSIONS;
        $dir   = base_path('Modules');
        $modules = scandir($dir);
        foreach ($modules as $k => $module) {
            $file = $dir . "\\" . $module . "\Utils\PermissionHelper.php";
            if (!in_array($module, array('.', '..'))) {
                if (file_exists($file)) {
                    $file = strstr($file, 'Modules');
                    $file = "\\" . str_replace(".php", "", $file);
                    $permissions = array_merge($permissions, $file::PERMISSIONS);
                }
            }
        };
        return $permissions;
    }
}

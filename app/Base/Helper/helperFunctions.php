<?php

use App\Models\Admin\Permission;
use Illuminate\Support\Facades\Route;

function resourcePermissions($group, $unit, $route, $ignore = [])
{
    $arr = [
        'عرض' => 'index',
        'اضافة' => 'store',
        'تفاصيل' => 'show',
        'تعديل' => 'update',
        'حذف' => 'destroy',
    ];
    foreach ($arr as $key => $value) {
        if (in_array($value, $ignore))
            continue;

        Permission::firstOrCreate([
            'name' => $key . ' ' . $unit,
            'routes' => $route . $value,
            'group' => $group,
        ]);
    }

    $export = array_reverse(explode('.', $route));
    if (isset($export[1])) {
        $module = $export[1];
        if (in_array('api.v1.admin.' . $module . '.export', array_keys(Route::getRoutes()->getRoutesByName()))) {
            Permission::firstOrCreate([
                'name' => 'سحب شيت اكسل ' . $unit,
                'routes' => $module . '.export',
                'group' => $group,
            ]);
        }
    }
}

function singlePermission($group, $name, $route)
{
    Permission::firstOrCreate([
        'name' => $name,
        'routes' => $route,
        'group' => $group,
    ]);
}

<?php

namespace App\Admin;

use App\Admin\Admin;

class Permission
{
    /**
     * Check permission.
     *
     * @param $permission
     *
     * @return true
     */
    public static function check($permission)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (is_array($permission)) {
            collect($permission)->each(function ($permission) {
                call_user_func([Permission::class, 'check'], $permission);
            });

            return;
        }

        if (Admin::user()->cannot($permission)) {
            return static::error();
        }
    }

    /**
     * Roles allowed to access.
     *
     * @param $roles
     *
     * @return true
     */
    public static function allow($roles)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (!Admin::user()->inRoles($roles)) {
            return static::error();
        }
    }

    /**
     * Don't check permission.
     *
     * @return bool
     */
    public static function free()
    {
        return true;
    }

    /**
     * Roles denied to access.
     *
     * @param $roles
     *
     * @return true
     */
    public static function deny($roles)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (Admin::user()->inRoles($roles)) {
            return static::error();
        }
    }

    /**
     * If current user is administrator.
     *
     * @return mixed
     */
    public static function isAdministrator()
    {
        return Admin::user()->isRole('administrator');
    }

    public static function error()
    {
        $uriCurrent = request()->fullUrl();
        $methodCurrent = request()->method();
        return redirect()->route('admin.deny')->with(['method' => $methodCurrent, 'url' => $uriCurrent]);
    }

}

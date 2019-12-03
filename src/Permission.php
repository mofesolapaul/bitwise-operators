<?php
/**
 * Created by Mofesola Banjo.
 * User: mb-pro-home
 * Date: 2019-12-02
 * Time: 17:29
 */

namespace App;


class Permission
{
    public const READ = 1;
    public const CREATE = 2;
    public const UPDATE = 7;
    public const DELETE = 8;
    private $permission;

    /**
     * Permission constructor.
     * @param int $defaultPermission
     */
    public function __construct(int $defaultPermission = self::READ)
    {
        $this->permission = $defaultPermission;
    }

    /**
     * @param int $permission
     * @return Permission
     */
    public final function grant(int $permission): Permission
    {
        $this->permission |= $permission;
        return $this;
    }

    /**
     * @param int $permission
     * @return bool
     */
    public final function check(int $permission): bool
    {
        return $permission === ($this->permission & $permission);
    }

    /**
     * @param int $permission
     * @return Permission
     */
    public final function revoke(int $permission): Permission
    {
        $this->permission ^= $permission;
        return $this;
    }

    public final function showPermissionInBinary(): void
    {
        echo decbin($this->permission);
    }
}
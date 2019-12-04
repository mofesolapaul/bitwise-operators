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

    /**
     * @var Bitwise $permission
     */
    private $permission;

    /**
     * Permission constructor.
     * @param int $defaultAccess
     */
    public function __construct(int $defaultAccess = self::READ)
    {
        $this->permission = Bitwise::createFromInteger($defaultAccess);
    }

    /**
     * @param int $permission
     * @return Permission
     */
    public final function grant(int $permission): Permission
    {
        $this->permission->or($permission);
        return $this;
    }

    /**
     * @param int $permission
     * @return bool
     */
    public final function check(int $permission): bool
    {
        return $permission === $this->permission->and($permission, false);
    }

    /**
     * @param int $permission
     * @return Permission
     */
    public final function revoke(int $permission): Permission
    {
        $this->permission->xor($permission);
        return $this;
    }

    public final function showPermissionInBinary(): void
    {
        echo $this->permission->getValue();
    }
}
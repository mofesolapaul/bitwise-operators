<?php

use App\Permission;
use PHPUnit\Framework\TestCase;

/**
 * Created by Mofesola Banjo.
 * User: mb-pro-home
 * Date: 2019-12-02
 * Time: 17:27
 */
class PermissionTest extends TestCase
{
    /**
     * @var Permission $permission
     */
    static $permission;

    public static function setUpBeforeClass(): void
    {
        self::$permission = new Permission();
    }

    /** @test */
    public final function permission_object_can_be_created(): void
    {
        self::assertInstanceOf(Permission::class, self::$permission);
    }

    /** @test */
    public final function read_permission_is_granted_by_default(): void
    {
        self::assertTrue(self::$permission->check(Permission::READ));
    }

    /** @test */
    public final function non_granted_permission_is_not_allowed(): void
    {
        self::assertFalse(self::$permission->check(Permission::CREATE));
    }

    /** @test */
    public final function granting_permissions_can_be_chained(): void
    {
        self::$permission->grant(Permission::CREATE)
            ->grant(Permission::DELETE)
            ->grant(Permission::UPDATE);
        self::assertTrue(self::$permission->check(Permission::CREATE));
        self::assertTrue(self::$permission->check(Permission::DELETE));
        self::assertTrue(self::$permission->check(Permission::UPDATE));
    }

    /** @test */
    public final function revoked_permission_is_not_allowed(): void
    {
        self::$permission->revoke(Permission::DELETE);
        self::assertFalse(self::$permission->check(Permission::DELETE));
    }

    /** @test */
    public final function previously_granted_permissions_remain_intact(): void
    {
        self::assertTrue(self::$permission->check(Permission::READ));
        self::assertTrue(self::$permission->check(Permission::CREATE));
        self::assertTrue(self::$permission->check(Permission::UPDATE));
    }
}

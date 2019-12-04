<?php

use App\Bitwise;
use PHPUnit\Framework\TestCase;

/**
 * Class BitwiseTest
 * Created by Mofesola Banjo.
 * User: mb-pro-home
 * Date: 2019-12-02
 * Time: 15:42
 */
class BitwiseTest extends TestCase
{
    /** @test */
    public final function bitwise_object_can_be_created_with_integer_value(): void
    {
        $bitwiseObject = Bitwise::createFromInteger(5);
        self::assertInstanceOf(Bitwise::class, $bitwiseObject);
        self::assertEquals("101", $bitwiseObject->getValue());
    }

    /** @test */
    public final function bitwise_object_can_be_created_with_string_value(): void
    {
        $bitwiseObject = Bitwise::createFromString("11");
        self::assertInstanceOf(Bitwise::class, $bitwiseObject);
        self::assertEquals("3", $bitwiseObject->getValueAsInteger());
    }

    /**
     * @test
     * @throws Exception
     */
    public final function error_is_thrown_when_non_binary_string_is_used_for_object_creation(): void
    {
        self::expectExceptionMessage("Invalid binary number supplied");
        $bitwise = Bitwise::createFromString("mofesola");
    }
}

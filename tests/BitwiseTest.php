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
    public final function bitwise_object_formats_binary_output(): void {
        $bitwiseObject = Bitwise::createFromInteger(1);
        self::assertEquals("001", $bitwiseObject->getValue());
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
        $bitwise = Bitwise::createFromString("101m");
    }

    /** @test */
    public final function bitwise_class_can_identify_binary_number(): void
    {
        self::assertTrue(Bitwise::isBinary("101"));
        self::assertFalse(Bitwise::isBinary("101m"));
    }

    /** @test */
    public final function bitwise_AND_works_with_integer_input(): void
    {
        $bitwise = Bitwise::createFromInteger(5);
        $bitwise->and(3);
        self::assertEquals("001", $bitwise->getValue());
    }

    /** @test */
    public final function bitwise_AND_works_with_bitwise_input(): void
    {
        $bitwiseA = Bitwise::createFromInteger(5);
        $bitwiseB = Bitwise::createFromInteger(3);
        $bitwiseA->and($bitwiseB);
        self::assertEquals("001", $bitwiseA->getValue());
    }

    /** @test */
    public final function bitwise_OR_works_with_integer_input(): void
    {
        $bitwise = Bitwise::createFromInteger(5);
        $bitwise->or(3);
        self::assertEquals("111", $bitwise->getValue());
    }

    /** @test */
    public final function bitwise_OR_works_with_bitwise_input(): void
    {
        $bitwiseA = Bitwise::createFromInteger(5);
        $bitwiseB = Bitwise::createFromInteger(3);
        $bitwiseA->or($bitwiseB);
        self::assertEquals("111", $bitwiseA->getValue());
    }

    /** @test */
    public final function bitwise_XOR_works_with_integer_input(): void
    {
        $bitwise = Bitwise::createFromInteger(5);
        $bitwise->xor(3);
        self::assertEquals("110", $bitwise->getValue());
    }

    /** @test */
    public final function bitwise_XOR_works_with_bitwise_input(): void
    {
        $bitwiseA = Bitwise::createFromInteger(5);
        $bitwiseB = Bitwise::createFromInteger(3);
        $bitwiseA->xor($bitwiseB);
        self::assertEquals("110", $bitwiseA->getValue());
    }
}

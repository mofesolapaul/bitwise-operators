<?php
/**
 * Created by Mofesola Banjo.
 * User: mb-pro-home
 * Date: 2019-12-02
 * Time: 15:55
 */

namespace App;

use PHPUnit\Util\Exception;

/**
 * Class Bitwise
 * @package App
 */
class Bitwise
{
    /**
     * @var string
     */
    private $value;

    /**
     * Bitwise constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
        $this->formatValue($value);
    }

    /**
     * @param int $value
     * @return Bitwise
     */
    public static function createFromInteger(int $value): Bitwise
    {
        $binaryEquivalent = decbin($value);
        return new self($binaryEquivalent);
    }

    /**
     * @param string $string
     * @return Bitwise
     * @throws \Exception
     */
    public static function createFromString(string $string): Bitwise
    {
        if (!self::isBinary($string)) {
            throw new Exception("Invalid binary number supplied");
        }
        return new self(strval($string));
    }

    /**
     * @param string $string
     * @return bool
     */
    public static function isBinary(string $string): bool
    {
        return !preg_match("/[^01]/", $string);
    }

    /**
     * @param string|null $incoming
     * @return int
     */
    private function minOutputLength(?string $incoming = ''): int
    {
        return max(
            strlen($this->value),
            strlen($incoming)
        );
    }

    /**
     * @param int|string $newValue
     * @param int $minLength
     */
    private function formatValue($newValue, int $minLength = 3): void
    {
        $valueInBinary = is_int($newValue) ? decbin($newValue) : $newValue;
        $newLength = strlen($valueInBinary);
        if ($newLength < $minLength) {
            $zeroes = str_repeat(0, $minLength - $newLength);
            $valueInBinary =  "{$zeroes}$valueInBinary";
        }
        $this->value = $valueInBinary;
    }

    /**
     * @return string
     */
    public final function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public final function getValueAsInteger(): int
    {
        return bindec($this->value);
    }

    /**
     * @param int|Bitwise $input
     * @param bool $updateValue
     */
    public final function and($input, $updateValue = true): int
    {
        $value = $input instanceof Bitwise ? $input->getValueAsInteger() : $input;
        $result = $this->getValueAsInteger() & $value;
        if ($updateValue) {
            $this->formatValue($result, $this->minOutputLength($result));
        }
        return $result;
    }

    /**
     * @param int|Bitwise $input
     */
    public final function or($input, $updateValue = true): int
    {
        $value = $input instanceof Bitwise ? $input->getValueAsInteger() : $input;
        $result = $this->getValueAsInteger() | $value;
        if ($updateValue) {
            $this->formatValue($result, $this->minOutputLength($result));
        }
        return $result;
    }

    /**
     * @param int|Bitwise $input
     */
    public final function xor($input, $updateValue = true): int
    {
        $value = $input instanceof Bitwise ? $input->getValueAsInteger() : $input;
        $result = $this->getValueAsInteger() ^ $value;
        if ($updateValue) {
            $this->formatValue($result, $this->minOutputLength($result));
        }
        return $result;
    }
}
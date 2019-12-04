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
        if (preg_match("/[^01]/", $string)) {
            throw new Exception("Invalid binary number supplied");
        }
        return new self(strval($string));
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
}
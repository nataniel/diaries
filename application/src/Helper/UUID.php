<?php
namespace Main\Helper;

use E4u\Request\Request;

class UUID
{
    const COOKIE_NAME = 'Diaries/UUID';
    const COOKIE_LIFETIME = 31104000; // 1 year

    /** @var string */
    private $path;

    /** @var string */
    private $name;

    /** @var int */
    private $lifetime;

    public function __construct($path, $name = self::COOKIE_NAME, $lifetime = self::COOKIE_LIFETIME)
    {
        $this->path = $path ?: '/';
        $this->name = $name;
        $this->lifetime = $lifetime;
    }

    /**
     * @param  string $value
     * @return $this
     */
    public function setCookie($value)
    {
        setcookie($this->name, $value, time() + $this->lifetime, $this->path);
        return $this;
    }

    /**
     * @return string
     */
    public function getCookie()
    {
        return isset($_COOKIE[ $this->name ])
            ? $_COOKIE[ $this->name ]
            : null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $value = $this->getCookie() ?: self::v4();
        $this->setCookie($value);
        return $value;
    }

    // https://www.php.net/manual/en/function.uniqid.php#94959
    public static function v4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
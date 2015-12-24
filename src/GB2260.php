<?php namespace cn;

class GB2260
{
    protected static $_data;

    public static function getData()
    {
        if (empty(self::$_data)) {
            self::$_data = require 'data.php';
        }

        return self::$_data;
    }

    public static function parse($code)
    {
        if (empty(self::$_data)) {
            self::$_data = require 'data.php';
        }

        $code = preg_replace('/0+$/', '', $code);
        $codeLength = strlen($code);
        if ($codeLength < 2 || $codeLength > 6 || $codeLength % 2 !== 0) {
            throw new \Exception('Invalid code');
        }

        $provinceCode = substr($code, 0, 2) . '0000';

        if (!isset(self::$_data[$provinceCode])) {
            return null;
        }

        $province = self::$_data[$provinceCode];
        if ($codeLength === 2) {
            return $province;
        }

        $areaCode = substr($code, 0, 4) . '00';

        if (!isset(self::$_data[$areaCode])) {
            return null;
        }

        $area = self::$_data[$areaCode];
        if ($codeLength === 4) {
            return $province . ' ' . $area;
        }

        if (!isset(self::$_data[$code])) {
            return null;
        }
        $name = self::$_data[$code];

        return $province . ' ' . $area . ' ' . $name;
    }
}

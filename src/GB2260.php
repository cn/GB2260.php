<?php

namespace GB2260;

class GB2260
{

    protected static $_data;

    public function __construct()
    {
        self::$_data = require 'data.php';
    }

    public function get($code)
    {
        $code = preg_replace('/(00)+$/', '', $code);
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

        $prefectureCode = substr($code, 0, 4) . '00';

        if (!isset(self::$_data[$prefectureCode])) {
            return null;
        }

        $area = self::$_data[$prefectureCode];
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

<?php namespace cn;

class GB2260
{
    protected static $_data;

    public static function getData()
    {
        if (empty(self::$_data)) {
            self::$_data = require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data.php';
        }

        return self::$_data;
    }

    public static function parse($code)
    {
        if (empty(self::$_data)) {
            self::$_data = require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data.php';
        }

        $code = (string)$code;
        $code = preg_replace('/0+$/', '', $code);
        $codeLength = strlen($code);
        if ($codeLength < 2 || $codeLength > 6 || $codeLength % 2 !== 0) {
            throw new \InvalidArgumentException('Invalid code');
        }

        $provinceKey = intval(substr($code, 0, 2) . '0000');
        if(!array_key_exists($provinceKey, self::$_data)){
            return null;
        }

        $province = self::$_data[$provinceKey];
        if ($codeLength === 2) {
            return $province;
        }

        $areaKey = intval(substr($code, 0, 4) . '00');
        if(!array_key_exists($areaKey, self::$_data)){
            return null;
        }

        $area = self::$_data[$areaKey];
        if ($codeLength === 4) {
            return $province . ' ' . $area;
        }

        $code = intval($code);
        if(!array_key_exists($code, self::$_data)){
            return null;
        }
        $name = self::$_data[$code];

        return $province . ' ' . $area . ' ' . $name;
    }
}

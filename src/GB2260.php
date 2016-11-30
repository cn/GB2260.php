<?php

namespace GB2260;

/**
 * Class GB2260
 * @package GB2260
 */
class GB2260
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * GB2260 constructor.
     */
    public function __construct()
    {
        $this->data = require __DIR__ . '/data.php';
    }

    /**
     * @param $code
     * @return null|string
     * @throws \Exception
     */
    public function get($code)
    {
        $code = preg_replace('/(00)+$/', '', $code);
        $codeLength = strlen($code);
        if ($codeLength < 2 || $codeLength > 6 || $codeLength % 2 !== 0) {
            throw new \Exception('Invalid code');
        }

        $provinceCode = substr($code, 0, 2) . '0000';

        if (!isset($this->data[$provinceCode])) {
            return null;
        }

        $province = $this->data[$provinceCode];

        if ($codeLength === 2) {
            return $province;
        }

        $prefectureCode = substr($code, 0, 4) . '00';

        if (!isset($this->data[$prefectureCode])) {
            return null;
        }

        $area = $this->data[$prefectureCode];

        if ($codeLength === 4) {
            return $province . ' ' . $area;
        }

        if (!isset($this->data[$code])) {
            return null;
        }

        $name = $this->data[$code];

        return $province . ' ' . $area . ' ' . $name;
    }

    /**
     * @param $city
     * @return string
     */
    public function getCode($city)
    {
        $params = explode(' ', $city);
        $result = [];

        foreach ($params as $key => $param) {
            $codes = array_keys($this->data, $param);
            if($key == 1) {
                if(count($codes) > 1) {
                    foreach ($codes as $k => $code) {
                        if((substr($code, 0, 2) != substr($result[0], 0, 2))) {
                            unset($codes[$k]);
                        }
                    }
                }
            }
            if($key == 2) {
                if(count($codes) > 1) {
                    foreach ($codes as $k => $code) {
                        if((substr($code, 0, 2) != substr($result[0], 0, 2)) ||
                            (substr($code, 0, 4) != substr($result[1], 0, 4))) {
                            unset($codes[$k]);
                        }
                    }
                }
            }
            $result[$key] = array_values($codes)[0];
        }
        return end($result);
    }
}

<?php

namespace GB2260;

class GB2260
{

    protected $data;

    public function __construct()
    {
        $this->data = require 'data.php';
    }

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
}

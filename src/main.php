<?php
require_once __DIR__ . '/GB2260.php';
$data = require __DIR__ . '/data.php';
$gb2260 = new \GB2260\GB2260();

//foreach ($data as $k => $d) {
//    $city = $gb2260->get($k);
//    $code = $gb2260->getCode($city);
//    if($code != $k) {
//        echo $k . "\t" . $d . "\t" . $code  . "\n";
//    }
//}

echo $gb2260->getCode('北京市 县 密云县');
//echo $gb2260->get(419001);
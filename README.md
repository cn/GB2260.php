# GB/T 2260

[![Build Status](https://img.shields.io/travis/cn/GB2260.php.svg?style=flat-square)](http://travis-ci.org/cn/GB2260.php)
[![version](https://img.shields.io/packagist/v/cn/gb2260.svg?style=flat-square)](https://packagist.org/packages/cn/gb2260)
[![Download](https://img.shields.io/packagist/dt/cn/gb2260.svg?style=flat-square)](https://packagist.org/packages/cn/gb2260)
[![codecov.io](https://img.shields.io/codecov/c/github/cn/GB2260.php.svg?style=flat-square)](https://codecov.io/github/cn/GB2260.php)


The latest GB/T 2260 codes. Updated at 2013, published at 2014.

## Installation

Install with Packagist:

```
$ composer install cn/gb2260
```

### .getData

Get data of GB/T 2260-2013.

```php
var_dump(cn\GB2260::getData());
```

### .parse(code)

Parse a code, and get the city name of that code.

```php
cn\GB2260::parse(420822);
// => '湖北省 荆门市 沙洋县'
```

## License

This software is licensed under the [MIT License](LICENSE).

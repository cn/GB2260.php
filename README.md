# GB/T 2260

[![Build Status](https://travis-ci.org/cn/GB2260.php.svg)](https://travis-ci.org/cn/GB2260.php)

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

WTFPL


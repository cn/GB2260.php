<?php

namespace GB2260\Tests;

use GB2260\GB2260;

class GB2260Test extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \GB2260\GB2260
     */
    protected $gb2260;

    public function setUp()
    {
        parent::setUp();

        $this->gb2260 = new GB2260();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid code
     */
    public function testGetInvalidCode()
    {
        $result = $this->gb2260->get(1);
    }

    /**
     * @dataProvider correctCodeProvider
     */
    public function testGet($code, $excepted)
    {
        $this->assertEquals($excepted, $this->gb2260->get($code));
    }

    /**
     * @dataProvider notExistedCodeProvider
     */
    public function testGetNotExisted($code)
    {
        $this->assertNull($this->gb2260->get($code));
    }

    public function correctCodeProvider()
    {
        return [
            [110000, '北京市'],
            [120000, '天津市'],
            [420800, '湖北省 荆门市'],
            [420822, '湖北省 荆门市 沙洋县'],
            [120100, '天津市 市辖区'],
            [120110, '天津市 市辖区 东丽区'],
        ];
    }

    public function notExistedCodeProvider()
    {
        return [
            [18],
            [423000],
            [120117],
            [110118],
            [130134],
        ];
    }
}

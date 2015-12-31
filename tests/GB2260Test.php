<?php

namespace cn\tests;

use cn\GB2260;

class GB2260Test extends \PHPUnit_Framework_TestCase
{
	public function testGetData()
	{
		$data = GB2260::getData();
		$this->assertTrue(is_array($data));
	}

	public function testCorrectGet()
	{
		$this->assertEquals('湖北省 荆门市 沙洋县', GB2260::parse(420822));
		$this->assertEquals('天津市 市辖区 东丽区', GB2260::parse(120110));
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage Invalid code
	 */
	public function testParseError()
	{
		$result = GB2260::parse(1);
	}

	/**
	 * @dataProvider provinceParseProvider
	 */
	public function testParseProvince($code, $excepted)
	{
		$result = GB2260::parse($code);

		$this->assertEquals($excepted, $result);
	}

	public function testNotExistsProvince()
	{
		$result = GB2260::parse(18);

		$this->assertNull($result);
	}

	public function testGetProvinceButNotArea()
	{
		$result = GB2260::parse(110977);
		$this->assertNull($result);
	}

	public function testGetArea()
	{
		$result = GB2260::parse(130200);
		$this->assertEquals('河北省 唐山市', $result);
	}

	/**
	 * @dataProvider badAreaCodes
	 */
	public function testWrongThirdLevel($code)
	{
		$result = GB2260::parse($code);
		$this->assertNull($result);
	}

	public function provinceParseProvider()
	{
		return array(
			array(110000, '北京市'),
			array(120000, '天津市')
		);
	}

	public function badAreaCodes()
	{
		return array(array(120117), array(110118), array(130134));
	}
}

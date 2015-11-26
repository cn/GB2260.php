<?php

class GB2260Test extends PHPUnit_Framework_TestCase
{
    public function testInvalidArgument()
    {
        $this->setExpectedException('InvalidArgumentException');
        cn\GB2260::parse(0);
    }

    public function testAll()
    {
        $this->assertNull(cn\GB2260::parse(811111));
        $this->assertEquals('香港特别行政区', cn\GB2260::parse(81));
        $this->assertEquals('香港特别行政区', cn\GB2260::parse(8100));
        $this->assertEquals('香港特别行政区', cn\GB2260::parse(810000));

        $this->assertNull(cn\GB2260::parse(91));
        $this->assertNull(cn\GB2260::parse(8101));
        $this->assertNull(cn\GB2260::parse(810001));

        $this->assertEquals('青海省', cn\GB2260::parse(630000));
        $this->assertEquals('青海省 西宁市', cn\GB2260::parse(630100));
        $this->assertEquals('青海省 西宁市', cn\GB2260::parse(630100));
        $this->assertEquals('青海省 西宁市 市辖区', cn\GB2260::parse(630101));
        $this->assertNull(cn\GB2260::parse(6304));
        $this->assertNull(cn\GB2260::parse(634004));
    }
}
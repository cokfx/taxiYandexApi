<?php

use DTS\eBaySDK\Trading\Types\LocalMarketSellerContactDetailsEnabledDefinitionType;

class LocalMarketSellerContactDetailsEnabledDefinitionTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new LocalMarketSellerContactDetailsEnabledDefinitionType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\LocalMarketSellerContactDetailsEnabledDefinitionType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}

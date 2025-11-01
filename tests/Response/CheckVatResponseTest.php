<?php

namespace DMT\Test\VatServiceEu\Response;

use DMT\VatServiceEu\Response\CheckVatResponse;
use PHPUnit\Framework\TestCase;

class CheckVatResponseTest extends TestCase
{
    public function testPropertyAccessors(): void
    {
        $checkVatResponse = new CheckVatResponse();
        $checkVatResponse->setCountryCode('BE');
        $checkVatResponse->setVatNumber('200933661162');
        $checkVatResponse->setRequestDate(new \DateTime('2018-11-11T00:00:00+01:00'));
        $checkVatResponse->setValid(true);
        $checkVatResponse->setName('Business \'n co');
        $checkVatResponse->setAddress('---');

        $this->assertSame('BE', $checkVatResponse->getCountryCode());
        $this->assertSame('200933661162', $checkVatResponse->getVatNumber());
        $this->assertEquals(new \DateTime('2018-11-11T00:00:00+01:00'), $checkVatResponse->getRequestDate());
        $this->assertTrue($checkVatResponse->isValid());
        $this->assertSame('Business \'n co', $checkVatResponse->getName());
        $this->assertSame('---', $checkVatResponse->getAddress());
    }
}

<?php

namespace DMT\Test\VatServiceEu\Response;

use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use PHPUnit\Framework\TestCase;

class CheckVatApproxResponseTest extends TestCase
{
    public function testPropertyAccessors(): void
    {
        $checkVatApproxResponse = new CheckVatApproxResponse();
        $checkVatApproxResponse->setCountryCode('NL');
        $checkVatApproxResponse->setVatNumber('887024345B01');
        $checkVatApproxResponse->setRequestDate(new \DateTime('2018-01-02T00:00:00+0100'));
        $checkVatApproxResponse->setValid(true);
        $checkVatApproxResponse->setTraderName('Company LTD');
        $checkVatApproxResponse->setTraderCompanyType('NL-12');
        $checkVatApproxResponse->setTraderAddress("\r\nFOOSTR 00012\r\n1234AB BAR");
        $checkVatApproxResponse->setTraderStreet('FOOSTR 00012');
        $checkVatApproxResponse->setTraderPostcode('1234AB');
        $checkVatApproxResponse->setTraderCity('BAR');
        $checkVatApproxResponse->setTraderNameMatch('Company');
        $checkVatApproxResponse->setTraderCompanyTypeMatch('---');
        $checkVatApproxResponse->setTraderStreetMatch('---');
        $checkVatApproxResponse->setTraderPostcodeMatch('---');
        $checkVatApproxResponse->setTraderCityMatch('Bar');
        $checkVatApproxResponse->setRequestIdentifier('wwe3ffsjj234hg67');

        $this->assertSame('NL', $checkVatApproxResponse->getCountryCode());
        $this->assertSame('887024345B01', $checkVatApproxResponse->getVatNumber());
        $this->assertEquals(new \DateTime('2018-01-02T00:00:00+0100'), $checkVatApproxResponse->getRequestDate());
        $this->assertTrue($checkVatApproxResponse->isValid());
        $this->assertSame('Company LTD', $checkVatApproxResponse->getTraderName());
        $this->assertSame('NL-12', $checkVatApproxResponse->getTraderCompanyType());
        $this->assertSame("\r\nFOOSTR 00012\r\n1234AB BAR", $checkVatApproxResponse->getTraderAddress());
        $this->assertSame('FOOSTR 00012', $checkVatApproxResponse->getTraderStreet());
        $this->assertSame('1234AB', $checkVatApproxResponse->getTraderPostcode());
        $this->assertSame('BAR', $checkVatApproxResponse->getTraderCity());
        $this->assertSame('Company', $checkVatApproxResponse->getTraderNameMatch());
        $this->assertSame('---', $checkVatApproxResponse->getTraderCompanyTypeMatch());
        $this->assertSame('---', $checkVatApproxResponse->getTraderStreetMatch());
        $this->assertSame('---', $checkVatApproxResponse->getTraderPostcodeMatch());
        $this->assertSame('Bar', $checkVatApproxResponse->getTraderCityMatch());
        $this->assertSame('wwe3ffsjj234hg67', $checkVatApproxResponse->getRequestIdentifier());
    }
}

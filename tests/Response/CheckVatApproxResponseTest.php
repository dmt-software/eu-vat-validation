<?php

namespace DMT\Test\VatServiceEu\Response;

use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use PHPUnit\Framework\TestCase;

class CheckVatApproxResponseTest extends TestCase
{
    public function testPropertyAccessors()
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

        static::assertSame('NL', $checkVatApproxResponse->getCountryCode());
        static::assertSame('887024345B01', $checkVatApproxResponse->getVatNumber());
        static::assertEquals(new \DateTime('2018-01-02T00:00:00+0100'), $checkVatApproxResponse->getRequestDate());
        static::assertTrue($checkVatApproxResponse->isValid());
        static::assertSame('Company LTD', $checkVatApproxResponse->getTraderName());
        static::assertSame('NL-12', $checkVatApproxResponse->getTraderCompanyType());
        static::assertSame("\r\nFOOSTR 00012\r\n1234AB BAR", $checkVatApproxResponse->getTraderAddress());
        static::assertSame('FOOSTR 00012', $checkVatApproxResponse->getTraderStreet());
        static::assertSame('1234AB', $checkVatApproxResponse->getTraderPostcode());
        static::assertSame('BAR', $checkVatApproxResponse->getTraderCity());
        static::assertSame('Company', $checkVatApproxResponse->getTraderNameMatch());
        static::assertSame('---', $checkVatApproxResponse->getTraderCompanyTypeMatch());
        static::assertSame('---', $checkVatApproxResponse->getTraderStreetMatch());
        static::assertSame('---', $checkVatApproxResponse->getTraderPostcodeMatch());
        static::assertSame('Bar', $checkVatApproxResponse->getTraderCityMatch());
        static::assertSame('wwe3ffsjj234hg67', $checkVatApproxResponse->getRequestIdentifier());
    }
}

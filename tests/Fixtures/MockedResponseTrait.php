<?php

namespace DMT\Test\VatServiceEu\Fixtures;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait MockedHandlerTrait
 */
trait MockedResponseTrait
{
    /**
     * A soap fault.
     *
     * @var string
     */
    protected $soapFault = <<<TXT
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <soap:Fault>
            <faultcode>soap:Server</faultcode>
            <faultstring>%s</faultstring>
        </soap:Fault>
    </soap:Body>
</soap:Envelope>
TXT;

    /**
     * The service response for a checkVatResponse.
     *
     * @var string
     */
    protected $checkVatResponse = <<<TXT
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <checkVatResponse xmlns="urn:ec.europa.eu:taxud:vies:services:checkVat:types">
            <countryCode>%s</countryCode>
            <vatNumber>%s</vatNumber>
            <requestDate>2016-06-16+02:00</requestDate>
            <valid>true</valid>
            <name>COMPANY &amp; CO</name>
            <address>
SOMEWHERE 00001
772498 CITY
            </address>
        </checkVatResponse>
    </soap:Body>
</soap:Envelope>
TXT;

    /**
     * The service response for a checkVatApproxResponse.
     *
     * @var string
     */
    protected $checkVatApproxResponse = <<<TXT
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <checkVatApproxResponse xmlns="urn:ec.europa.eu:taxud:vies:services:checkVat:types">
            <countryCode>%s</countryCode>
            <vatNumber>%s</vatNumber>
            <requestDate>2016-07-03+02:00</requestDate>
            <valid>false</valid>
            <traderName>---</traderName>
            <traderCompanyType>---</traderCompanyType>
            <traderAddress>---</traderAddress>
            <requestIdentifier>WAPIAAAAVWwuR3lh</requestIdentifier>
        </checkVatApproxResponse>
    </soap:Body>
</soap:Envelope>
TXT;

    /**
     * Get a mocked service response.
     *
     * @param string $template
     * @param mixed ...$arguments
     *
     * @return ResponseInterface
     */
    public function getMockedResponse(string $template, ...$arguments): ResponseInterface
    {
        return new Response(200, [], vsprintf($template, $arguments));
    }
}
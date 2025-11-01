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
    protected static $soapFault = <<<TXT
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
    protected static $checkVatResponse = <<<TXT
<env:Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/">
    <env:Header/>
    <env:Body>
        <ns2:checkVatResponse xmlns:ns2="urn:ec.europa.eu:taxud:vies:services:checkVat:types">
            <ns2:countryCode>%s</ns2:countryCode>
            <ns2:vatNumber>%s</ns2:vatNumber>
            <ns2:requestDate>2023-10-24+02:00</ns2:requestDate>
            <ns2:valid>true</ns2:valid>
            <ns2:name></ns2:name>
            <ns2:address></ns2:address>
        </ns2:checkVatResponse>
    </env:Body>
</env:Envelope>
TXT;

    /**
     * The service response for a checkVatApproxResponse.
     *
     * @var string
     */
    protected static $checkVatApproxResponse = <<<TXT
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
    public static function getMockedResponse(string $template, ...$arguments): ResponseInterface
    {
        return new Response(200, [], vsprintf($template, $arguments));
    }
}

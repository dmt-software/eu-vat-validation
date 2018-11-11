<?php

namespace DMT\Test\VatServiceEu\Handler;

use DMT\Soap\Serializer\SoapFaultException;
use DMT\Test\VatServiceEu\Fixtures\MockedResponseTrait;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class CheckVatHandlerTest extends TestCase
{
    use MockedResponseTrait;

    /**
     * Test the testCheckVat method.
     */
    public function testCheckVat()
    {
        $httpClient = new \GuzzleHttp\Client([
            'handler' => HandlerStack::create(
                new MockHandler([
                    $this->getMockedResponse($this->checkVatResponse, 'NL', '840888644B01')
                ])
            )
        ]);

        $handler = new CheckVatHandler($httpClient, ClientBuilder::create()->getSerializer());
        $response = $handler->handleCheckVat(new CheckVat());

        static::assertSame('NL', $response->getCountryCode());
        static::assertSame('840888644B01', $response->getVatNumber());
        static::assertTrue($response->isValid());
    }

    /**
     * @dataProvider provideSoapFault
     *
     * @param \GuzzleHttp\Client $httpClient
     * @param string $message
     */
    public function testCheckVatSoapFaults(\GuzzleHttp\Client $httpClient, string $message)
    {
        static::expectExceptionObject(new SoapFaultException('Server', $message));

        $handler = new CheckVatHandler($httpClient, ClientBuilder::create()->getSerializer());
        $handler->handleCheckVat(new CheckVat());
    }

    /**
     * Test the checkVatApprox method.
     */
    public function testCheckVatApprox()
    {
        $httpClient = new \GuzzleHttp\Client([
            'handler' => HandlerStack::create(
                new MockHandler([
                    $this->getMockedResponse($this->checkVatApproxResponse, 'GB', '8863')
                ])
            )
        ]);

        $handler = new CheckVatHandler($httpClient, ClientBuilder::create()->getSerializer());
        $response = $handler->handleCheckVatApprox(new CheckVatApprox());

        static::assertSame('GB', $response->getCountryCode());
        static::assertSame('8863', $response->getVatNumber());
        static::assertFalse($response->isValid());
    }

    /**
     * @dataProvider provideSoapFault
     *
     * @param \GuzzleHttp\Client $httpClient
     * @param string $message
     */
    public function testCheckVatApproxSoapFaults(\GuzzleHttp\Client $httpClient, string $message)
    {
        static::expectExceptionObject(new SoapFaultException('Server', $message));

        $handler = new CheckVatHandler($httpClient, ClientBuilder::create()->getSerializer());
        $handler->handleCheckVatApprox(new CheckVatApprox());
    }

    /**
     * @return array
     */
    public function provideSoapFault(): array
    {
        $httpClient = new \GuzzleHttp\Client([
            'handler' => HandlerStack::create(
                new MockHandler([
                    $this->getMockedResponse($this->soapFault, 'INVALID_INPUT'),
                    $this->getMockedResponse($this->soapFault, 'INVALID_REQUESTER_INFO'),
                    $this->getMockedResponse($this->soapFault, 'SERVICE_UNAVAILABLE'),
                    $this->getMockedResponse($this->soapFault, 'MS_UNAVAILABLE'),
                    $this->getMockedResponse($this->soapFault, 'TIMEOUT'),
                    $this->getMockedResponse($this->soapFault, 'VAT_BLOCKED'),
                    $this->getMockedResponse($this->soapFault, 'IP_BLOCKED'),
                    $this->getMockedResponse($this->soapFault, 'GLOBAL_MAX_CONCURRENT_REQ'),
                    $this->getMockedResponse($this->soapFault, 'GLOBAL_MAX_CONCURRENT_REQ_TIME'),
                    $this->getMockedResponse($this->soapFault, 'MS_MAX_CONCURRENT_REQ'),
                    $this->getMockedResponse($this->soapFault, 'MS_MAX_CONCURRENT_REQ_TIME'),
                ])
            )
        ]);

        return [
            [$httpClient, 'INVALID_INPUT'],
            [$httpClient, 'INVALID_REQUESTER_INFO'],
            [$httpClient, 'SERVICE_UNAVAILABLE'],
            [$httpClient, 'MS_UNAVAILABLE'],
            [$httpClient, 'TIMEOUT'],
            [$httpClient, 'VAT_BLOCKED'],
            [$httpClient, 'IP_BLOCKED'],
            [$httpClient, 'GLOBAL_MAX_CONCURRENT_REQ'],
            [$httpClient, 'GLOBAL_MAX_CONCURRENT_REQ_TIME'],
            [$httpClient, 'MS_MAX_CONCURRENT_REQ'],
            [$httpClient, 'MS_MAX_CONCURRENT_REQ_TIME'],
        ];
    }
}

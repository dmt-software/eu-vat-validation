<?php

namespace DMT\Test\VatServiceEu\Handler;

use DMT\Http\Client\RequestHandler;
use DMT\Soap\Serializer\SoapFaultException;
use DMT\Test\VatServiceEu\Fixtures\MockedResponseTrait;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\HttpFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CheckVatHandlerTest extends TestCase
{
    use MockedResponseTrait;

    public function testCheckVat(): void
    {
        $httpClient = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([
                    $this->getMockedResponse(self::$checkVatResponse, 'NL', '840888644B01')
                ])
            )
        ]);

        $handler = new CheckVatHandler(
            new RequestHandler($httpClient),
            ClientBuilder::create($httpClient, new HttpFactory())->getSerializer(),
            new HttpFactory()
        );
        $response = $handler->handleCheckVat(new CheckVat());

        $this->assertSame('NL', $response->getCountryCode());
        $this->assertSame('840888644B01', $response->getVatNumber());
        $this->assertTrue($response->isValid());
    }

    #[DataProvider(methodName: 'provideSoapFault')]
    public function testCheckVatSoapFaults(HttpClient $httpClient, string $message): void
    {
        static::expectExceptionObject(new SoapFaultException('Server', $message));

        $handler = new CheckVatHandler(
            new RequestHandler($httpClient),
            ClientBuilder::create($httpClient, new HttpFactory())->getSerializer(),
            new HttpFactory()
        );
        $handler->handleCheckVat(new CheckVat());
    }

    public function testCheckVatApprox(): void
    {
        $httpClient = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([
                    $this->getMockedResponse(self::$checkVatApproxResponse, 'GB', '8863')
                ])
            )
        ]);

        $handler = new CheckVatHandler(
            new RequestHandler($httpClient),
            ClientBuilder::create($httpClient, new HttpFactory())->getSerializer(),
            new HttpFactory()
        );
        $response = $handler->handleCheckVatApprox(new CheckVatApprox());

        $this->assertSame('GB', $response->getCountryCode());
        $this->assertSame('8863', $response->getVatNumber());
        $this->assertFalse($response->isValid());
    }

    #[DataProvider(methodName: 'provideSoapFault')]
    public function testCheckVatApproxSoapFaults(HttpClient $httpClient, string $message)
    {
        static::expectExceptionObject(new SoapFaultException('Server', $message));

        $handler = new CheckVatHandler(
            new RequestHandler($httpClient),
            ClientBuilder::create($httpClient, new HttpFactory())->getSerializer(),
            new HttpFactory()
        );
        $handler->handleCheckVatApprox(new CheckVatApprox());
    }

    public static function provideSoapFault(): iterable
    {
        $httpClient = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([
                    static::getMockedResponse(self::$soapFault, 'INVALID_INPUT'),
                    static::getMockedResponse(self::$soapFault, 'INVALID_REQUESTER_INFO'),
                    static::getMockedResponse(self::$soapFault, 'SERVICE_UNAVAILABLE'),
                    static::getMockedResponse(self::$soapFault, 'MS_UNAVAILABLE'),
                    static::getMockedResponse(self::$soapFault, 'TIMEOUT'),
                    static::getMockedResponse(self::$soapFault, 'VAT_BLOCKED'),
                    static::getMockedResponse(self::$soapFault, 'IP_BLOCKED'),
                    static::getMockedResponse(self::$soapFault, 'GLOBAL_MAX_CONCURRENT_REQ'),
                    static::getMockedResponse(self::$soapFault, 'GLOBAL_MAX_CONCURRENT_REQ_TIME'),
                    static::getMockedResponse(self::$soapFault, 'MS_MAX_CONCURRENT_REQ'),
                    static::getMockedResponse(self::$soapFault, 'MS_MAX_CONCURRENT_REQ_TIME'),
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

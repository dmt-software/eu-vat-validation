<?php

namespace DMT\Test\VatServiceEu;

use DMT\VatServiceEu\Client;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\HttpFactory;
use JMS\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    public function testBuildClient()
    {
        $this->assertInstanceOf(Client::class, ClientBuilder::create(new HttpClient(), new HttpFactory())->build());
    }

    /**
     * Check it the correct handler is returned when requested.
     */
    public function testHandlerLocator()
    {
        $this->assertInstanceOf(CheckVatHandler::class, ClientBuilder::create(new HttpClient(), new HttpFactory())->getCheckVatHandler());
    }

    /**
     * Test if the configured soap serializer is returned.
     */
    public function testGetSerializer()
    {
        $this->assertInstanceOf(Serializer::class, ClientBuilder::create(new HttpClient(), new HttpFactory())->getSerializer());
    }
}

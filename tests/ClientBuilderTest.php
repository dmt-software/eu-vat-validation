<?php

namespace DMT\Test\VatServiceEu;

use DMT\VatServiceEu\Client;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use JMS\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    public function testBuildClient()
    {
        $this->assertInstanceOf(Client::class, ClientBuilder::create()->build());
    }

    /**
     * Check it the correct handler is returned when requested.
     */
    public function testHandlerLocator()
    {
        $this->assertInstanceOf(CheckVatHandler::class, ClientBuilder::create()->getCheckVatHandler());
    }

    /**
     * Test if the configured soap serializer is returned.
     */
    public function testGetSerializer()
    {
        $this->assertInstanceOf(Serializer::class, ClientBuilder::create()->getSerializer());
    }
}

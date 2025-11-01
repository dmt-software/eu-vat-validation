<?php

namespace DMT\Test\VatServiceEu;

use DMT\VatServiceEu\Client;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use DMT\VatServiceEu\Response\CheckVatResponse;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\HttpFactory;
use League\Tactician\CommandBus;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * Test client interface.
     */
    public function testCheckVat()
    {
        /** @var CommandBus|MockObject $commandBus */
        $commandBus = $this->createMock(CommandBus::class);
        $commandBus
            ->expects($this->any())
            ->method('handle')
            ->willReturn(new CheckVatResponse());

        $client = new Client($commandBus);

        $this->assertInstanceOf(CheckVatResponse::class, $client->execute(new CheckVat()));
    }

    /**
     * Test client interface.
     */
    public function testCheckVatApprox()
    {
        /** @var CommandBus|MockObject $commandBus */
        $commandBus = $this->createMock(CommandBus::class);
        $commandBus
            ->expects($this->any())
            ->method('handle')
            ->willReturn(new CheckVatApproxResponse());

        $client = new Client($commandBus);

        $this->assertInstanceOf(CheckVatApproxResponse::class, $client->execute(new CheckVatApprox()));
    }

    #[Group('functional')]
    public function testClientImplementation(): void
    {
        $request = new CheckVat();
        $request->setCountryCode('NL');
        $request->setVatNumber('804888644B01');

        $client = ClientBuilder::create(new HttpClient(), new HttpFactory())->build();

        /** @var CheckVatResponse $response */
        $response = $client->execute($request);

        $this->assertSame($request->getCountryCode(), $response->getCountryCode());
        $this->assertSame($request->getVatNumber(), $response->getVatNumber());
        $this->assertIsBool($response->isValid());
    }
}

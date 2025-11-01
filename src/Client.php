<?php

namespace DMT\VatServiceEu;

use DMT\VatServiceEu\Request\RequestInterface;
use DMT\VatServiceEu\Response\ResponseInterface;
use League\Tactician\CommandBus;

/**
 * Class Client
 *
 * Implementation on the VIES VAT validation service.
 *
 * {@link} http://ec.europa.eu/taxation_customs/vies/services/checkVatService?wsdl=checkVatPortType.wsdl
 */
class Client
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    /**
     * Execute the request
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        return $this->commandBus->handle($request);
    }
}
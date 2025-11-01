<?php

namespace DMT\VatServiceEu\Handler;

use DMT\Http\Client\RequestHandlerInterface;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use DMT\VatServiceEu\Request\RequestInterface;
use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use DMT\VatServiceEu\Response\CheckVatResponse;
use DMT\VatServiceEu\Response\ResponseInterface;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class CheckVatHandler
 *
 * Manages the request to the VIES VAT validation web service.
 */
class CheckVatHandler
{
    public function __construct(
        private RequestHandlerInterface $requestHandler,
        private SerializerInterface $serializer,
        private RequestFactoryInterface $requestFactory
    ) {
    }

    /**
     * Check a VAT number against the VIES VAT validation service.
     */
    public function handleCheckVat(CheckVat $checkVat): CheckVatResponse
    {
        return $this->execute($checkVat, CheckVatResponse::class);
    }

    /**
     * Check a VAT number against the VIES VAT validation service.
     */
    public function handleCheckVatApprox(CheckVatApprox $checkVatApprox): CheckVatApproxResponse
    {
        return $this->execute($checkVatApprox, CheckVatApproxResponse::class);
    }

    /**
     * Execute the request on the VIES VAT web service.
     *
     * @template T
     *
     * @param RequestInterface $request
     * @param class-string<T> $responseClass
     *
     * @return T of ResponseInterface
     */
    private function execute(RequestInterface $request, string $responseClass): ResponseInterface
    {
        $httpRequest = $this->requestFactory
            ->createRequest(
                'POST',
                'https://ec.europa.eu/taxation_customs/vies/services/checkVatService'
            )
            ->withHeader('Content-Type', 'text/xml; charset=utf-8')
            ->withHeader( 'SOAPAction', '""');
        $httpRequest->getBody()->write($this->serializer->serialize($request, 'soap'));

        $httpResponse = $this->requestHandler->handle($httpRequest);

        return $this->serializer->deserialize($httpResponse->getBody(), $responseClass, 'soap');
    }
}

<?php

namespace DMT\VatServiceEu\Handler;

use DMT\Http\Client\RequestHandlerInterface;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use DMT\VatServiceEu\Request\RequestInterface;
use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use DMT\VatServiceEu\Response\CheckVatResponse;
use DMT\VatServiceEu\Response\ResponseInterface;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class CheckVatHandler
 *
 * Manages the request to the VIES VAT validation web service.
 */
class CheckVatHandler
{
    /**
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * CheckVatHandler constructor.
     *
     * @param RequestHandlerInterface $httpClient
     * @param SerializerInterface $serializer
     */
    public function __construct(
        RequestHandlerInterface $httpClient,
        SerializerInterface     $serializer,
        RequestFactoryInterface $requestFactory
    )
    {
        $this->requestHandler = $httpClient;
        $this->serializer = $serializer;
        $this->requestFactory = $requestFactory;
    }

    /**
     * Check a VAT number against the VIES VAT validation service.
     *
     * @param CheckVat $checkVat
     * @return CheckVatResponse
     */
    public function handleCheckVat(CheckVat $checkVat): CheckVatResponse
    {
        return $this->execute($checkVat, CheckVatResponse::class);
    }

    /**
     * Check a VAT number against the VIES VAT validation service.
     *
     * @param CheckVatApprox $checkVatApprox
     * @return CheckVatApproxResponse
     */
    public function handleCheckVatApprox(CheckVatApprox $checkVatApprox): CheckVatApproxResponse
    {
        return $this->execute($checkVatApprox, CheckVatApproxResponse::class);
    }

    /**
     * Execute the request on the VIES VAT web service.
     *
     * @param RequestInterface $request
     * @param string $responseClass
     * @return CheckVatResponse|CheckVatApproxResponse
     */
    protected function execute(RequestInterface $request, string $responseClass): ResponseInterface
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

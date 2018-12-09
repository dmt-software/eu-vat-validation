<?php

namespace DMT\VatServiceEu\Handler;

use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Request\CheckVatApprox;
use DMT\VatServiceEu\Request\RequestInterface;
use DMT\VatServiceEu\Response\CheckVatApproxResponse;
use DMT\VatServiceEu\Response\CheckVatResponse;
use DMT\VatServiceEu\Response\ResponseInterface;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class CheckVatHandler
 *
 * Manages the request to the VIES VAT validation web service.
 */
class CheckVatHandler
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * CheckVatHander constructor.
     * @param Client $httpClient
     * @param SerializerInterface $serializer
     */
    public function __construct(Client $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
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
        $httpRequest = $this->serializer->serialize($request, 'soap');

        $httpResponse = $this->httpClient->post(
            'http://ec.europa.eu/taxation_customs/vies/services/checkVatService',
            [
                'SOAPAction' => '""',
                'Content-Type' => 'text/xml; charset=utf-8',
                'body' => $httpRequest
            ]
        );

        return $this->serializer->deserialize($httpResponse->getBody(), $responseClass, 'soap');
    }
}
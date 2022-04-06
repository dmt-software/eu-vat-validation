<?php

namespace DMT\VatServiceEu;

use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Http\Client\RequestHandler;
use DMT\Soap\Serializer\SoapDateHandler;
use DMT\Soap\Serializer\SoapDeserializationVisitorFactory;
use DMT\Soap\Serializer\SoapMessageEventSubscriber;
use DMT\Soap\Serializer\SoapSerializationVisitorFactory;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameWithoutSuffixInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class ClientBuilder
{
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    /**
     * Create the client builder
     *
     * @param ClientInterface $client
     * @param RequestFactoryInterface $requestFactory
     * @return ClientBuilder
     */
    public static function create(ClientInterface $client, RequestFactoryInterface $requestFactory): ClientBuilder
    {
        return (new static())
            ->setClient($client)
            ->setRequestFactory($requestFactory);
    }

    /**
     * @param ClientInterface $client
     * @return ClientBuilder
     */
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     * @return ClientBuilder
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    /**
     * Build the client.
     *
     * @return Client
     */
    public function build(): Client
    {
        return new Client(
            new CommandBus([
                new LockingMiddleware(),
                new ValidationMiddleware(),
                new CommandHandlerMiddleware(
                    new ClassNameExtractor(),
                    new CallableLocator([$this, 'getCheckVatHandler']),
                    new HandleClassNameWithoutSuffixInflector('Request')
                )
            ])
        );
    }

    /**
     * Get the handler that handles the service requests.
     *
     * @return CheckVatHandler
     */
    public function getCheckVatHandler(): CheckVatHandler
    {
        return new CheckVatHandler(new RequestHandler($this->client), $this->getSerializer(), $this->requestFactory);
    }

    /**
     * Get the soap serializer.
     *
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        return
            SerializerBuilder::create()
                ->setSerializationVisitor('soap', new SoapSerializationVisitorFactory())
                ->setDeserializationVisitor('soap', new SoapDeserializationVisitorFactory())
                ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
                ->configureListeners(
                    function (EventDispatcher $dispatcher) {
                        $dispatcher->addSubscriber(
                            new SoapMessageEventSubscriber()
                        );
                    }
                )
                ->configureHandlers(function (HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new SoapDateHandler());
                })
                ->build()
            ;
    }
}
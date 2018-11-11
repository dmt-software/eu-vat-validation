<?php

namespace DMT\VatServiceEu;

use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Soap\Serializer\SoapDateHandler;
use DMT\Soap\Serializer\SoapDeserializationVisitor;
use DMT\Soap\Serializer\SoapSerializationVisitor;
use DMT\VatServiceEu\Handler\CheckVatHandler;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameWithoutSuffixInflector;
use League\Tactician\Plugins\LockingMiddleware;

class ClientBuilder
{
    /**
     * Create the client builder
     *
     * @return ClientBuilder
     */
    public static function create(): ClientBuilder
    {
        return new static();
    }

    /**
     * Build the client.
     *
     * @return Client
     * @throws \Doctrine\Common\Annotations\AnnotationException
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
        return new CheckVatHandler(new \GuzzleHttp\Client(), $this->getSerializer());
    }

    /**
     * Get the soap serializer.
     *
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        AnnotationRegistry::registerUniqueLoader('class_exists');

        $namingStrategy = new IdenticalPropertyNamingStrategy();

        return
            SerializerBuilder::create()
                ->setSerializationVisitor('soap', new SoapSerializationVisitor($namingStrategy))
                ->setDeserializationVisitor('soap', new SoapDeserializationVisitor($namingStrategy))
                ->configureHandlers(function (HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new SoapDateHandler());
                })
                ->build()
            ;
    }
}
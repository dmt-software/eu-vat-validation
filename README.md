# VatValidation Client

[![Build Status](https://travis-ci.org/dmt-software/eu-vat-validation.svg?branch=master)](https://travis-ci.org/dmt-software/eu-vat-validation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dmt-software/eu-vat-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dmt-software/eu-vat-validation/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/dmt-software/eu-vat-validation/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dmt-software/eu-vat-validation/?branch=master)

> This package contains a client to consume the EU VIES Vat soap-service. 
> 
> Please keep in mind that there is a [disclaimer](http://ec.europa.eu/taxation_customs/vies/disclaimer.html) for using 
> the VAT service. This also applies to using this package. 
 
## Install
`composer require dmt-software/eu-vat-validation`

## Usage

```php
<?php

use DMT\CommandBus\Validator\ValidationException;
use DMT\Soap\Serializer\SoapFaultException;
use DMT\VatServiceEu\ClientBuilder;
use DMT\VatServiceEu\Request\CheckVat;
use DMT\VatServiceEu\Response\CheckVatResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

try {
    $request = new CheckVat();
    $request->setCountryCode('NL');
    $request->setVatNumber('804888644B01');

    /** @var ClientInterface $client */
    /** @var RequestFactoryInterface $requestFactory */
    $client = ClientBuilder::create($client, $requestFactory)->build();
    
    /** @var CheckVatResponse $response */
    $response = $client->execute($request);
    
    if ($response->isValid()) {
        // some business logic ...
    }
} catch (ValidationException $exception) {
    // input was incorrect
    foreach ($exception->getViolations() as $violation) {
        print $violation->getMessage();
    }
} catch (SoapFaultException $exception) {
    // service returned an error
    print $exception->getMessage();
}
```

## Further reading
* [VIES VAT number validation](http://ec.europa.eu/taxation_customs/vies/)
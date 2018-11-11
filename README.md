# VatValidation Client



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

try {
    $request = new CheckVat();
    $request->setCountryCode('NL');
    $request->setVatNumber('804888644B01');

    $client = ClientBuilder::create()->build();
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
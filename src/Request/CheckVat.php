<?php

namespace DMT\VatServiceEu\Request;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

#[JMS\XmlNamespace(uri: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types', prefix: 'ns1')]
#[JMS\XmlRoot(name: 'checkVat', namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
#[JMS\AccessType(type: 'public_method')]
class CheckVat implements RequestInterface
{
    #[Assert\NotBlank(message: 'countryCode is required')]
    #[Assert\Regex(pattern: '/^[A-Z]{2}$/', message: 'countryCode is invalid')]
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $countryCode = null;

    #[Assert\NotBlank(message: 'vatNumber is required')]
    #[Assert\Regex(pattern: '/^[0-9A-Za-z\+\*\.]{2,12}$/', message: 'vatNumber is invalid')]
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $vatNumber = null;

    public function getCountryCode(): null|string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getVatNumber(): null|string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }
}

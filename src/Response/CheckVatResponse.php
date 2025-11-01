<?php

namespace DMT\VatServiceEu\Response;

use DateTime;
use JMS\Serializer\Annotation as JMS;

#[JMS\XmlNamespace(uri: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
#[JMS\XmlRoot(name: 'checkVatResponse')]
#[JMS\AccessType(type: 'public_method')]
class CheckVatResponse implements ResponseInterface
{
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $countryCode = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $vatNumber = null;

    #[JMS\Type("DateTime<'Y-m-dP'>")]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|DateTime $requestDate = null;

    #[JMS\Type('bool')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|bool $valid = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $name = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $address = null;

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }

    public function getRequestDate(): ?DateTime
    {
        return $this->requestDate;
    }

    public function setRequestDate(DateTime $requestDate): void
    {
        $this->requestDate = $requestDate;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}

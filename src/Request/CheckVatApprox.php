<?php

namespace DMT\VatServiceEu\Request;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

#[JMS\XmlNamespace(uri: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types', prefix: 'ns1')]
#[JMS\XmlRoot(name: 'checkVatApprox', namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
#[JMS\AccessType(type: 'public_method')]
class CheckVatApprox implements RequestInterface
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

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderName = null;

    #[Assert\Regex(pattern: '/^[A-Z]{2}\-[1-9][0-9]?$/', message: 'traderCompanyType is invalid')]
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCompanyType = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderStreet = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderPostcode = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCity = null;

    #[Assert\Regex(pattern: '/^[A-Z]{2}$/', message: 'requesterCountryCode is invalid')]
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $requesterCountryCode = null;

    #[Assert\Regex(pattern: '/^[0-9A-Za-z\+\*\.]{2,12}$/', message: 'requesterVatNumber is invalid')]
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $requesterVatNumber = null;

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

    public function getTraderName(): null|string
    {
        return $this->traderName;
    }

    public function setTraderName(string $traderName): void
    {
        $this->traderName = $traderName;
    }

    public function getTraderCompanyType(): null|string
    {
        return $this->traderCompanyType;
    }

    public function setTraderCompanyType(string $traderCompanyType): void
    {
        $this->traderCompanyType = $traderCompanyType;
    }

    public function getTraderStreet(): null|string
    {
        return $this->traderStreet;
    }

    public function setTraderStreet(string $traderStreet): void
    {
        $this->traderStreet = $traderStreet;
    }

    public function getTraderPostcode(): null|string
    {
        return $this->traderPostcode;
    }

    public function setTraderPostcode(string $traderPostcode): void
    {
        $this->traderPostcode = $traderPostcode;
    }

    public function getTraderCity(): null|string
    {
        return $this->traderCity;
    }

    public function setTraderCity(string $traderCity): void
    {
        $this->traderCity = $traderCity;
    }

    public function getRequesterCountryCode(): null|string
    {
        return $this->requesterCountryCode;
    }

    public function setRequesterCountryCode(string $requesterCountryCode): void
    {
        $this->requesterCountryCode = $requesterCountryCode;
    }

    public function getRequesterVatNumber(): null|string
    {
        return $this->requesterVatNumber;
    }

    public function setRequesterVatNumber(string $requesterVatNumber): void
    {
        $this->requesterVatNumber = $requesterVatNumber;
    }
}

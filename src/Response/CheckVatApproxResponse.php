<?php

namespace DMT\VatServiceEu\Response;

use DateTime;
use JMS\Serializer\Annotation as JMS;

#[JMS\XmlNamespace(uri: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types', prefix: 'ns1')]
#[JMS\XmlRoot(name: 'checkVatApproxResponse')]
#[JMS\AccessType(type: 'public_method')]
class CheckVatApproxResponse implements ResponseInterface
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

    #[JMS\Type('boolean')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|bool $valid = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderName = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCompanyType = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderAddress = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderStreet = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderPostcode = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCity = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderNameMatch = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCompanyTypeMatch = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderStreetMatch = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderPostcodeMatch = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $traderCityMatch = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:ec.europa.eu:taxud:vies:services:checkVat:types')]
    protected null|string $requestIdentifier = null;

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

    public function getTraderName(): ?string
    {
        return $this->traderName;
    }

    public function setTraderName(string $traderName): void
    {
        $this->traderName = $traderName;
    }

    public function getTraderCompanyType(): ?string
    {
        return $this->traderCompanyType;
    }

    public function setTraderCompanyType(string $traderCompanyType): void
    {
        $this->traderCompanyType = $traderCompanyType;
    }

    public function getTraderAddress(): ?string
    {
        return $this->traderAddress;
    }

    public function setTraderAddress(string $traderAddress): void
    {
        $this->traderAddress = $traderAddress;
    }

    public function getTraderStreet(): ?string
    {
        return $this->traderStreet;
    }

    public function setTraderStreet(string $traderStreet): void
    {
        $this->traderStreet = $traderStreet;
    }

    public function getTraderPostcode(): ?string
    {
        return $this->traderPostcode;
    }

    public function setTraderPostcode(string $traderPostcode): void
    {
        $this->traderPostcode = $traderPostcode;
    }

    public function getTraderCity(): ?string
    {
        return $this->traderCity;
    }

    public function setTraderCity(string $traderCity): void
    {
        $this->traderCity = $traderCity;
    }

    public function getTraderNameMatch(): ?string
    {
        return $this->traderNameMatch;
    }

    public function setTraderNameMatch(string $traderNameMatch): void
    {
        $this->traderNameMatch = $traderNameMatch;
    }

    public function getTraderCompanyTypeMatch(): ?string
    {
        return $this->traderCompanyTypeMatch;
    }

    public function setTraderCompanyTypeMatch(string $traderCompanyTypeMatch): void
    {
        $this->traderCompanyTypeMatch = $traderCompanyTypeMatch;
    }

    public function getTraderStreetMatch(): ?string
    {
        return $this->traderStreetMatch;
    }

    public function setTraderStreetMatch(string $traderStreetMatch): void
    {
        $this->traderStreetMatch = $traderStreetMatch;
    }

    public function getTraderPostcodeMatch(): ?string
    {
        return $this->traderPostcodeMatch;
    }

    public function setTraderPostcodeMatch(string $traderPostcodeMatch): void
    {
        $this->traderPostcodeMatch = $traderPostcodeMatch;
    }

    public function getTraderCityMatch(): ?string
    {
        return $this->traderCityMatch;
    }

    public function setTraderCityMatch(string $traderCityMatch): void
    {
        $this->traderCityMatch = $traderCityMatch;
    }

    public function getRequestIdentifier(): ?string
    {
        return $this->requestIdentifier;
    }

    public function setRequestIdentifier(string $requestIdentifier): void
    {
        $this->requestIdentifier = $requestIdentifier;
    }
}

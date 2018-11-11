<?php

namespace DMT\VatServiceEu\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class CheckVatApproxResponse
 *
 * @JMS\AccessType("public_method")
 * @JMS\XmlNamespace(uri="urn:ec.europa.eu:taxud:vies:services:checkVat:types", prefix="ns1")
 * @JMS\XmlRoot("checkVatApproxResponse")
 */
class CheckVatApproxResponse implements ResponseInterface
{
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $countryCode;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $vatNumber;
                                    
    /**
     * @JMS\Type("DateTime<'Y-m-dP'>")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var \DateTime
     */
    protected $requestDate;
                                    
    /**
     * @JMS\Type("boolean")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var bool
     */
    protected $valid;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderName;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderCompanyType;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderAddress;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderStreet;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderPostcode;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderCity;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderNameMatch;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderCompanyTypeMatch;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderStreetMatch;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderPostcodeMatch;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderCityMatch;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $requestIdentifier;
                                    
    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
                                    
    /**
     * @return string
     */
    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }
                                    
    /**
     * @return \DateTime
     */
    public function getRequestDate(): ?\DateTime
    {
        return $this->requestDate;
    }

    /**
     * @param \DateTime $requestDate
     */
    public function setRequestDate(\DateTime $requestDate): void
    {
        $this->requestDate = $requestDate;
    }
                                    
    /**
     * @return bool
     */
    public function isValid(): ?bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }
                                    
    /**
     * @return string
     */
    public function getTraderName(): ?string
    {
        return $this->traderName;
    }

    /**
     * @param string $traderName
     */
    public function setTraderName(string $traderName): void
    {
        $this->traderName = $traderName;
    }
                                    
    /**
     * @return string
     */
    public function getTraderCompanyType(): ?string
    {
        return $this->traderCompanyType;
    }

    /**
     * @param string $traderCompanyType
     */
    public function setTraderCompanyType(string $traderCompanyType): void
    {
        $this->traderCompanyType = $traderCompanyType;
    }
                                    
    /**
     * @return string
     */
    public function getTraderAddress(): ?string
    {
        return $this->traderAddress;
    }

    /**
     * @param string $traderAddress
     */
    public function setTraderAddress(string $traderAddress): void
    {
        $this->traderAddress = $traderAddress;
    }
                                    
    /**
     * @return string
     */
    public function getTraderStreet(): ?string
    {
        return $this->traderStreet;
    }

    /**
     * @param string $traderStreet
     */
    public function setTraderStreet(string $traderStreet): void
    {
        $this->traderStreet = $traderStreet;
    }
                                    
    /**
     * @return string
     */
    public function getTraderPostcode(): ?string
    {
        return $this->traderPostcode;
    }

    /**
     * @param string $traderPostcode
     */
    public function setTraderPostcode(string $traderPostcode): void
    {
        $this->traderPostcode = $traderPostcode;
    }
                                    
    /**
     * @return string
     */
    public function getTraderCity(): ?string
    {
        return $this->traderCity;
    }

    /**
     * @param string $traderCity
     */
    public function setTraderCity(string $traderCity): void
    {
        $this->traderCity = $traderCity;
    }
                                    
    /**
     * @return string
     */
    public function getTraderNameMatch(): ?string
    {
        return $this->traderNameMatch;
    }

    /**
     * @param string $traderNameMatch
     */
    public function setTraderNameMatch(string $traderNameMatch): void
    {
        $this->traderNameMatch = $traderNameMatch;
    }
                                    
    /**
     * @return string
     */
    public function getTraderCompanyTypeMatch(): ?string
    {
        return $this->traderCompanyTypeMatch;
    }

    /**
     * @param string $traderCompanyTypeMatch
     */
    public function setTraderCompanyTypeMatch(string $traderCompanyTypeMatch): void
    {
        $this->traderCompanyTypeMatch = $traderCompanyTypeMatch;
    }
                                    
    /**
     * @return string
     */
    public function getTraderStreetMatch(): ?string
    {
        return $this->traderStreetMatch;
    }

    /**
     * @param string $traderStreetMatch
     */
    public function setTraderStreetMatch(string $traderStreetMatch): void
    {
        $this->traderStreetMatch = $traderStreetMatch;
    }
                                    
    /**
     * @return string
     */
    public function getTraderPostcodeMatch(): ?string
    {
        return $this->traderPostcodeMatch;
    }

    /**
     * @param string $traderPostcodeMatch
     */
    public function setTraderPostcodeMatch(string $traderPostcodeMatch): void
    {
        $this->traderPostcodeMatch = $traderPostcodeMatch;
    }
                                    
    /**
     * @return string
     */
    public function getTraderCityMatch(): ?string
    {
        return $this->traderCityMatch;
    }

    /**
     * @param string $traderCityMatch
     */
    public function setTraderCityMatch(string $traderCityMatch): void
    {
        $this->traderCityMatch = $traderCityMatch;
    }
                                    
    /**
     * @return string
     */
    public function getRequestIdentifier(): ?string
    {
        return $this->requestIdentifier;
    }

    /**
     * @param string $requestIdentifier
     */
    public function setRequestIdentifier(string $requestIdentifier): void
    {
        $this->requestIdentifier = $requestIdentifier;
    }
}

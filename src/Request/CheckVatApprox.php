<?php

namespace DMT\VatServiceEu\Request;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CheckVatApprox
 *
 * @JMS\AccessType("public_method")
 * @JMS\XmlNamespace(uri="urn:ec.europa.eu:taxud:vies:services:checkVat:types", prefix="ns1")
 * @JMS\XmlRoot("checkVatApprox", namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
 */
class CheckVatApprox implements RequestInterface
{
    /**
     * @Assert\NotBlank(message="countryCode is required")
     * @Assert\Regex(pattern="/^[A-Z]{2}$/", message="countryCode is invalid")
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $countryCode;
                                    
    /**
     * @Assert\NotBlank(message="vatNumber is required")
     * @Assert\Regex(pattern="/^[0-9A-Za-z\+\*\.]{2,12}$/", message="vatNumber is invalid")
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $vatNumber;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $traderName;
                                    
    /**
     * @Assert\Regex(pattern="/^[A-Z]{2}\-[1-9][0-9]?$/", message="traderCompanyType is invalid")
     *
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
     * @Assert\Regex(pattern="/^[A-Z]{2}$/", message="requesterCountryCode is invalid")
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $requesterCountryCode;
                                    
    /**
     * @Assert\Regex(pattern="/^[0-9A-Za-z\+\*\.]{2,12}$/", message="requesterVatNumber is invalid")
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $requesterVatNumber;

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
    public function getRequesterCountryCode(): ?string
    {
        return $this->requesterCountryCode;
    }

    /**
     * @param string $requesterCountryCode
     */
    public function setRequesterCountryCode(string $requesterCountryCode): void
    {
        $this->requesterCountryCode = $requesterCountryCode;
    }

    /**
     * @return string
     */
    public function getRequesterVatNumber(): ?string
    {
        return $this->requesterVatNumber;
    }

    /**
     * @param string $requesterVatNumber
     */
    public function setRequesterVatNumber(string $requesterVatNumber): void
    {
        $this->requesterVatNumber = $requesterVatNumber;
    }
}

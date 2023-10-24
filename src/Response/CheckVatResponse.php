<?php

namespace DMT\VatServiceEu\Response;

use DateTime;
use JMS\Serializer\Annotation as JMS;

/**
 * Class CheckVatResponse
 *
 * @JMS\AccessType("public_method")
 * @JMS\XmlNamespace("urn:ec.europa.eu:taxud:vies:services:checkVat:types")
 * @JMS\XmlRoot("checkVatResponse")
 */
class CheckVatResponse implements ResponseInterface
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
     * @var DateTime
     */
    protected $requestDate;
                                    
    /**
     * @JMS\Type("boolean")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var boolean
     */
    protected $valid;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $name;
                                    
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
     *
     * @var string
     */
    protected $address;

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
     * @return DateTime
     */
    public function getRequestDate(): ?DateTime
    {
        return $this->requestDate;
    }

    /**
     * @param DateTime $requestDate
     */
    public function setRequestDate(DateTime $requestDate): void
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}

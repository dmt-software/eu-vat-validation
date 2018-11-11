<?php

namespace DMT\VatServiceEu\Request;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CheckVat
 *
 * @JMS\AccessType("public_method")
 * @JMS\XmlNamespace(uri="urn:ec.europa.eu:taxud:vies:services:checkVat:types", prefix="ns1")
 * @JMS\XmlRoot("checkVat", namespace="urn:ec.europa.eu:taxud:vies:services:checkVat:types")
 */
class CheckVat implements RequestInterface
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
}

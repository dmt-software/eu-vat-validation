<?php

namespace DMT\Test\VatServiceEu\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\VatServiceEu\Request\CheckVatApprox;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;

class CheckVatApproxTest extends TestCase
{
    public function testPropertyAccessors(): void
    {
        $checkVatApprox = new CheckVatApprox();
        $checkVatApprox->setCountryCode('NL');
        $checkVatApprox->setVatNumber('999.6655322');
        $checkVatApprox->setTraderName('Company and co');
        $checkVatApprox->setTraderCompanyType('NL-18');
        $checkVatApprox->setTraderStreet('Foolane 1');
        $checkVatApprox->setTraderPostcode('44377');
        $checkVatApprox->setTraderCity('Bar');
        $checkVatApprox->setRequesterCountryCode('BE');
        $checkVatApprox->setRequesterVatNumber('882664.557788');

        $this->assertSame('NL', $checkVatApprox->getCountryCode());
        $this->assertSame('999.6655322', $checkVatApprox->getVatNumber());
        $this->assertSame('Company and co', $checkVatApprox->getTraderName());
        $this->assertSame('NL-18', $checkVatApprox->getTraderCompanyType());
        $this->assertSame('Foolane 1', $checkVatApprox->getTraderStreet());
        $this->assertSame('44377', $checkVatApprox->getTraderPostcode());
        $this->assertSame('Bar', $checkVatApprox->getTraderCity());
        $this->assertSame('BE', $checkVatApprox->getRequesterCountryCode());
        $this->assertSame('882664.557788', $checkVatApprox->getRequesterVatNumber());
    }

    #[DataProvider('provideViolation')]
    public function testValidation(CheckVatApprox $checkVat, string $message): void
    {
        try {
            $validator = new ValidationMiddleware();
            $validator->execute($checkVat, function (): void {});
        } catch (ValidationException $exception) {
            $violations = array_map(
                fn(ConstraintViolation $violation) => $violation->getMessage(),
                iterator_to_array($exception->getViolations())
            );
            $this->assertContains($message, $violations);
        }
    }

    public static function provideViolation(): iterable
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->build();

        $checkVats = [
            [['countryCode' => 'NL'], 'vatNumber is required'],
            [['countryCode' => 'BE', 'vatNumber' => ''], 'vatNumber is required'],
            [['countryCode' => 'FR', 'vatNumber' => '2'], 'vatNumber is invalid'],
            [['countryCode' => 'DE', 'vatNumber' => '2-884-99743'], 'vatNumber is invalid'],
            [['countryCode' => 'GB', 'vatNumber' => '1234509876hd32'], 'vatNumber is invalid'],
            [['vatNumber' => '6647*33444'], 'countryCode is required'],
            [['countryCode' => '', 'vatNumber' => '324.12355'], 'countryCode is required'],
            [['countryCode' => 'POR', 'vatNumber' => '13664992'], 'countryCode is invalid'],
            [['countryCode' => 'I', 'vatNumber' => '88742134'], 'countryCode is invalid'],
            [['traderCompanyType' => 'NL'], 'traderCompanyType is invalid'],
            [['traderCompanyType' => 'NL-776'], 'traderCompanyType is invalid'],
            [['requesterCountryCode' => '23'], 'requesterCountryCode is invalid'],
            [['requesterVatNumber' => '12343876432234243'], 'requesterVatNumber is invalid'],
        ];

        foreach ($checkVats as $checkVat) {
            $message = array_pop($checkVat);
            $checkVat = $serializer->fromArray(array_shift($checkVat), CheckVatApprox::class);

            yield [$checkVat, $message];
        }
    }
}

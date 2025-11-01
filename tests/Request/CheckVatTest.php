<?php

namespace DMT\Test\VatServiceEu\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\VatServiceEu\Request\CheckVat;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;

class CheckVatTest extends TestCase
{
    public function testPropertyAccessors(): void
    {
        $request = new CheckVat();
        $request->setCountryCode('FR');
        $request->setVatNumber('9774300278');

        $this->assertSame('FR', $request->getCountryCode());
        $this->assertSame('9774300278', $request->getVatNumber());
    }

    #[DataProvider(methodName: 'provideViolation')]
    public function testValidation(CheckVat $checkVat, string $message): void
    {
        try {
            $validator = new ValidationMiddleware();
            $validator->execute($checkVat, function (): void {});
        } catch (ValidationException $exception) {
            $violations = array_map(
                fn(ConstraintViolation $violation) => $violation->getMessage(),
                iterator_to_array($exception->getViolations())
            );
            $this->assertCount(1, $exception->getViolations());
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
        ];

        foreach ($checkVats as $checkVat) {
            $message = array_pop($checkVat);
            $checkVat = $serializer->fromArray(array_shift($checkVat), CheckVat::class);

            yield [$checkVat, $message];
        }
    }
}

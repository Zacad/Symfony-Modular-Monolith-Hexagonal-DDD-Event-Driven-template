<?php

namespace App\Tests\PricingModule\Application;

use App\Common\Bus\Command\CommandBusInterface;
use App\Common\ValueObject\Money;
use App\PricingModule\Domain\Repository\PriceRepositoryInterface;

class CreatePriceTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel(
            [
                'environment' => 'test'
            ]
        );
    }

    public function testCreatePriceCommand(): void
    {
        // given
        $command = new \App\PricingModule\Application\Command\CreatePriceCommand(
            id: \Ramsey\Uuid\Uuid::uuid4(),
            sku: 'sku',
            priceList: 'priceList',
            price: Money::fromFloatAmount(
                amount: 100,
                currency: 'PLN',
            ),
        );

        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $priceRepository = static::getContainer()->get(PriceRepositoryInterface::class);

        // when

        $commandBus->execute($command);

        $price = $priceRepository->findById($command->id);

        // then

        $this->assertInstanceOf(\App\PricingModule\Domain\Entity\Price::class, $price);
    }
}
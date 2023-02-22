<?php

namespace App\Tests\ProductModule\Infrastructure\EventHandler;

use App\Common\Bus\Command\CommandBusInterface;
use App\Common\ValueObject\Money;
use App\PricingModule\Application\Command\CreatePriceCommand;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Presentation\ReadModel\ProductReadModel;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class PriceCreatedEventHandlerTest extends KernelTestCase
{


    public function setUp(): void
    {
        self::bootKernel(
            [
                'environment' => 'test'
            ]
        );
    }

    public function testItUpdateProductViewWithPrice()
    {
        // given
        $sku = '123';
        $priceList = 'priceList';
        $amount = 100;
        $currency = 'PLN';
        $createPriceCommand = new CreatePriceCommand(
            id: Uuid::uuid4(),
            sku: $sku,
            priceList: $priceList,
            price: Money::fromFloatAmount(
                amount: $amount,
                currency: $currency,
            ),
        );


        $createProductCommand = new CreateExampleOneCommand(
            id: Uuid::uuid4(),
            sku: $sku,
            name: 'Example one',
        );


        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $productReadModel = static::getContainer()->get(ProductReadModel::class);

        // when
        $commandBus->execute($createPriceCommand);
        $commandBus->execute($createProductCommand);

        $view = $productReadModel->getProductView($createProductCommand->sku);
        // then


        $this->assertSame($createProductCommand->id->toString(), $view['id']->toString());
        $this->assertSame($createProductCommand->name, $view['name']);
        $this->assertSame($createProductCommand->sku, $view['sku']);
        $this->assertSame($createPriceCommand->price->getAmount(), $view['prices'][$priceList]->getAmount());
        $this->assertSame($createPriceCommand->price->getCurrency(), $view['prices'][$priceList]->getCurrency());
    }
}
<?php

namespace App\Tests\ProductModule\Infrastructure\EventHandler;

use App\Common\Bus\Command\CommandBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Presentation\ReadModel\ProductReadModel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductCreatedEventHandlerTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel(
            [
                'environment' => 'test'
            ]
        );
    }

    public function testItUpdateReadModel()
    {
        // given
        $command = new CreateExampleOneCommand(
            id: \Ramsey\Uuid\Uuid::uuid4(),
            sku: '123',
            name: 'Example one',
        );

        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $productReadModel = static::getContainer()->get(ProductReadModel::class);

        // when
        $commandBus->execute($command);

        $view = $productReadModel->getProductView($command->sku);
        // then

        $this->assertSame($command->id->toString(), $view['id']->toString());
        $this->assertSame($command->name, $view['name']);
        $this->assertSame($command->sku, $view['sku']);
    }
}
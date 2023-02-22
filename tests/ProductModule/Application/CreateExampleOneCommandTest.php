<?php

namespace App\Tests\ProductModule\Application;

use App\Common\Bus\Command\CommandBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Domain\Entity\Product;
use App\ProductModule\Domain\Repository\ProductRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateExampleOneCommandTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel(
            [
                'environment' => 'test'
            ]
        );
    }

    public function testCreateExampleOneCommand(): void
    {
        // given
        $command = new CreateExampleOneCommand(
            id: Uuid::uuid4(),
            sku: '123',
            name: 'Example two',
        );

        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $exampleOneRepository = static::getContainer()->get(ProductRepositoryInterface::class);

        // when

        $commandBus->execute($command);

        $product = $exampleOneRepository->findById($command->id);

        // then

        $this->assertInstanceOf(Product::class, $product);
    }
}
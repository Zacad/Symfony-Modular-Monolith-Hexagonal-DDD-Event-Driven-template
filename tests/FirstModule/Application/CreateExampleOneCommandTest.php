<?php

namespace App\Tests\FirstModule\Application;

use App\Common\Bus\Command\CommandBusInterface;
use App\Common\ValueObject\Money;
use App\FirstModule\Application\Command\CreateExampleOneCommand;
use App\FirstModule\Domain\Entity\ExampleOne;
use App\FirstModule\Domain\Repository\ExampleOneRepositoryInterface;
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
            name: 'Example two',
            price: Money::fromFloatAmount(100.00, 'EUR'),
        );

        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $exampleOneRepository = static::getContainer()->get(ExampleOneRepositoryInterface::class);

        // when

        $commandBus->execute($command);

        $exampleOne = $exampleOneRepository->findById($command->id);

        // then

        $this->assertInstanceOf(ExampleOne::class, $exampleOne);
    }
}
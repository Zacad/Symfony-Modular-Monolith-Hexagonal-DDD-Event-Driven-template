<?php

namespace App\ProductModule\Application\CommandHandler;

use App\Common\Bus\Event\EventBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Domain\Entity\ExampleOne;
use App\ProductModule\Domain\Event\CreateExampleOneEvent;
use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
use App\ProductModule\Domain\ValueObject\Price;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateExampleOneCommandHandler
{
    public function __construct(
        private readonly ExampleOneRepositoryInterface $exampleOneRepository,
        private readonly EventBusInterface $eventBus,
    ) {
    }

    public function __invoke(CreateExampleOneCommand $command): void
    {
        try {
            $price = Price::fromMoney($command->price);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        $exampleOne = new ExampleOne(
            $command->id,
            $command->name,
            $price,
        );

        try {
            $this->exampleOneRepository->save($exampleOne);

            $this->eventBus->dispatch(
                new CreateExampleOneEvent(
                    $exampleOne->getId(),
                    $exampleOne->getName(),
                    $exampleOne->getPrice()->toMoney()
                ),
            );
        } catch (UniqueConstraintViolationException $e) {
            throw new \InvalidArgumentException('ExampleOne with this id already exists');
        }
    }
}
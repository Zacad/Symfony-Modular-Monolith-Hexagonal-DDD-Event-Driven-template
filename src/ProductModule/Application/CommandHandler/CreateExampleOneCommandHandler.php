<?php

namespace App\ProductModule\Application\CommandHandler;

use App\Common\Bus\Event\EventBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Domain\Entity\Product;
use App\ProductModule\Domain\Event\ProductCreatedEvent;
use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
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
        $exampleOne = new Product(
            $command->id,
            $command->name,
        );

        try {
            $this->exampleOneRepository->save($exampleOne);

            $this->eventBus->dispatch(
                new ProductCreatedEvent(
                    $exampleOne->getId(),
                    $exampleOne->getName(),
                ),
            );
        } catch (UniqueConstraintViolationException $e) {
            throw new \InvalidArgumentException('ExampleOne with this id already exists');
        }
    }
}
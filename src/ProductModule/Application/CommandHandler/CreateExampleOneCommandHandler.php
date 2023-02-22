<?php

namespace App\ProductModule\Application\CommandHandler;

use App\Common\Bus\Event\EventBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use App\ProductModule\Domain\Entity\Product;
use App\ProductModule\Domain\Event\ProductCreatedEvent;
use App\ProductModule\Domain\Repository\ProductRepositoryInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateExampleOneCommandHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $exampleOneRepository,
        private readonly EventBusInterface $eventBus,
    ) {
    }

    public function __invoke(CreateExampleOneCommand $command): void
    {
        $product = new Product(
            $command->id,
            $command->sku,
            $command->name,
        );

        try {
            $this->exampleOneRepository->save($product);

            $this->eventBus->dispatch(
                new ProductCreatedEvent(
                    $product->getId(),
                    $product->getSku(),
                    $product->getName(),
                ),
            );
        } catch (UniqueConstraintViolationException $e) {
            throw new \InvalidArgumentException('ExampleOne with this id already exists');
        }
    }
}
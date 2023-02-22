<?php

namespace App\ProductModule\Infrastructure\EventHandler;

use App\ProductModule\Domain\Event\ProductCreatedEvent;
use App\ProductModule\ReadModel\ExampleOneReadModel;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateExampleOneEventHandler
{
    public function __construct(
        private readonly ExampleOneReadModel $exampleOneReadModel,
    ) {
    }

    public function __invoke(ProductCreatedEvent $event): void
    {
        $this->exampleOneReadModel->update($event->id);
    }


}
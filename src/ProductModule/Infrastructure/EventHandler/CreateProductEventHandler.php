<?php

namespace App\ProductModule\Infrastructure\EventHandler;

use App\ProductModule\Domain\Event\ProductCreatedEvent;
use App\ProductModule\Presentation\ReadModel\ProductReadModel;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateProductEventHandler
{
    public function __construct(
        private readonly ProductReadModel $exampleOneReadModel,
    ) {
    }

    public function __invoke(ProductCreatedEvent $event): void
    {
        $this->exampleOneReadModel->createView($event->id);
    }


}
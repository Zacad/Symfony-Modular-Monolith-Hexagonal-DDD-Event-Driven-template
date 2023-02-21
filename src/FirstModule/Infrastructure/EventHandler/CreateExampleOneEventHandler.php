<?php

namespace App\FirstModule\Infrastructure\EventHandler;

use App\FirstModule\Domain\Event\CreateExampleOneEvent;
use App\FirstModule\ReadModel\ExampleOneReadModel;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateExampleOneEventHandler
{
    public function __construct(
        private readonly ExampleOneReadModel $exampleOneReadModel,
    ) {
    }

    public function __invoke(CreateExampleOneEvent $event): void
    {
        $this->exampleOneReadModel->update($event->id);
    }


}
<?php

namespace App\Common\Bus\Event;

use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $eventBus,
    ) {
    }

    public function dispatch(AbstractEvent $event): void
    {
        $this->eventBus->dispatch(
            $event,
        );
    }
}
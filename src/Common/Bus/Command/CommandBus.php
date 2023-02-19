<?php

namespace App\Common\Bus\Command;

use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    public function execute(AbstractCommand $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
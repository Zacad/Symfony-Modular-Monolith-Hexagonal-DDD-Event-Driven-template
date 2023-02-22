<?php

namespace App\Common\Bus\Query;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(
        private readonly MessageBusInterface $queryBus,
    ) {
        $this->messageBus = $queryBus;
    }

    public function query(AbstractQuery $event): iterable
    {
        return $this->handle(
            $event,
        );
    }


}
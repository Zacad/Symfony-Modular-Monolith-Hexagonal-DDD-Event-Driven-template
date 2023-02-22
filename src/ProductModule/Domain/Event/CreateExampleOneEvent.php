<?php

namespace App\ProductModule\Domain\Event;

use App\Common\Bus\Event\AbstractEvent;
use Ramsey\Uuid\UuidInterface;

class CreateExampleOneEvent extends AbstractEvent
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $name,
    ) {
    }

}
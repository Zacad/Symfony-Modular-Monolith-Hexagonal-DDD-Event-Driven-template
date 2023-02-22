<?php

namespace App\ProductModule\Application\Command;

use App\Common\Bus\Command\AbstractCommand;
use Ramsey\Uuid\UuidInterface;

class CreateExampleOneCommand extends AbstractCommand
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $name,
    ) {
    }
}
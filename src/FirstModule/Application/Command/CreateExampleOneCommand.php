<?php

namespace App\FirstModule\Application\Command;

use App\Common\Bus\Command\AbstractCommand;
use App\Common\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class CreateExampleOneCommand extends AbstractCommand
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $name,
        public readonly Money $price,
    ) {
    }
}
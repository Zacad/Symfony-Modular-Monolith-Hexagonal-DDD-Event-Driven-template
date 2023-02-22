<?php

namespace App\ProductModule\Domain\Repository;

use App\ProductModule\Domain\Entity\ExampleOne;
use Ramsey\Uuid\UuidInterface;

interface ExampleOneRepositoryInterface
{
    public function save(ExampleOne $exampleOne): void;

    public function findById(UuidInterface $id): ?ExampleOne;
}
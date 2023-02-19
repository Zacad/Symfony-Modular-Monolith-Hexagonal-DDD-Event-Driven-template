<?php

namespace App\FirstModule\Domain\Repository;

use App\FirstModule\Domain\Entity\ExampleOne;
use Ramsey\Uuid\UuidInterface;

interface ExampleOneRepositoryInterface
{
    public function save(ExampleOne $exampleOne): void;
    public function findById(UuidInterface $id): ?ExampleOne;
}
<?php

namespace App\ProductModule\Domain\Repository;

use App\ProductModule\Domain\Entity\Product;
use Ramsey\Uuid\UuidInterface;

interface ExampleOneRepositoryInterface
{
    public function save(Product $exampleOne): void;

    public function findById(UuidInterface $id): ?Product;
}
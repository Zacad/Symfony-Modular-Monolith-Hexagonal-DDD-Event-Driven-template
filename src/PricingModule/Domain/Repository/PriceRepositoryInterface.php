<?php

namespace App\PricingModule\Domain\Repository;

use App\PricingModule\Domain\Entity\Price;
use Ramsey\Uuid\UuidInterface;

interface PriceRepositoryInterface
{

    public function save(Price $price): void;

    public function findById(UuidInterface $id): ?Price;
}
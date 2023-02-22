<?php

namespace App\ProductModule\Domain\ValueObject;

use App\Common\ValueObject\Money;

class Price
{
    public function __construct(
        private Money $price,
    ) {
        if ($price->getPennyAmount() < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }
    }

    public static function fromPennyAmount(int $priceAmount, string $priceCurrency)
    {
        return new self(Money::fromPennyAmount($priceAmount, $priceCurrency));
    }

    public static function fromMoney(Money $price)
    {
        return new self($price);
    }

    public function isEqualTo(Price $price): bool
    {
        return $this->price->isEqualTo($price->price);
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getPennyAmount(): int
    {
        return $this->price->getPennyAmount();
    }

    public function getCurrency(): string
    {
        return $this->price->getCurrency();
    }

    public function toMoney()
    {
        return $this->price;
    }
}
<?php

namespace App\FirstModule\Domain\ValueObject;

use App\Common\ValueObject\Money;

class Price
{
    public function __construct(
       private Money $price,
    ){
        if ($price->pennyAmount() < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }
    }

    public static function fromPennyAmount(int $priceAmount, string $priceCurrency)
    {
        return new self(Money::fromFloatAmount($priceAmount, $priceCurrency));
    }

    public function isEqualTo(Price $price): bool
    {
        return $this->price->isEqualTo($price->price);
    }

    public function price(): Money
    {
        return $this->price;
    }

    public function pennyAmount()
    {
        return $this->price->pennyAmount();
    }

    public function currency()
    {
        return $this->price->currency();
    }
}
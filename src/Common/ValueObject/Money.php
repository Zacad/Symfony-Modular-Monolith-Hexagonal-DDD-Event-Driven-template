<?php

namespace App\Common\ValueObject;

class Money
{
    private function __construct(
        private int $pennyAmount,
        private string $currency,
    ) {
    }

    public static function fromFloatAmount(float $amount, string $currency): self
    {
        return new self((int)($amount * 100), $currency);
    }

    public static function fromPennyAmount(int $priceAmount, string $priceCurrency)
    {
        return new self($priceAmount, $priceCurrency);
    }

    public function isEqualTo(Money $money): bool
    {
        return $this->pennyAmount === $money->pennyAmount && $this->currency === $money->currency;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPennyAmount(): int
    {
        return $this->pennyAmount;
    }

    public function getAmount(): float
    {
        return $this->pennyAmount / 100;
    }

}
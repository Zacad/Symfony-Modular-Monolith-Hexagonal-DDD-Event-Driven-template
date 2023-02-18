<?php

namespace App\Common\ValueObject;

class Money
{
    private function __construct(
        private int $pennyAmount,
        private string $currency,
    )
    {
    }

    public static function fromFloatAmount(float $amount, string $currency): self
    {
        return new self((int) ($amount * 100), $currency);
    }

    public function isEqualTo(Money $money): bool
    {
        return $this->pennyAmount === $money->pennyAmount && $this->currency === $money->currency;
    }
}
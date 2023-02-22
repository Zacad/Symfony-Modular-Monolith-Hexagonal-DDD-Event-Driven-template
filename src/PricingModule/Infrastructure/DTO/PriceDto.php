<?php

namespace App\PricingModule\Infrastructure\DTO;

use App\Common\ValueObject\Money;

class PriceDto
{
    public function __construct(
        public readonly string $sku,
        public readonly string $priceList,
        public readonly Money $price,
    ) {
    }
}
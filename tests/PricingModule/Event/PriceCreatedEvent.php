<?php

namespace App\Tests\PricingModule\Event;

use App\Common\Bus\Event\AbstractEvent;
use App\Common\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class PriceCreatedEvent extends AbstractEvent
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $sku,
        public readonly string $priceList,
        public readonly Money $price,
    ) {
    }
}
<?php

namespace App\PricingModule\Application\Command;

use App\Common\Bus\Command\AbstractCommand;
use App\Common\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class CreatePriceCommand extends AbstractCommand
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $sku,
        public readonly string $priceList,
        public readonly Money $price,
    ) {
    }
}
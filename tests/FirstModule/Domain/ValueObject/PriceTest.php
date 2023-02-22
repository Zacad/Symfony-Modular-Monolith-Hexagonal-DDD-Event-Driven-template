<?php

namespace App\Tests\ProductModule\Domain\ValueObject;

use App\ProductModule\Domain\ValueObject\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testPriceCannotBeNegative()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Price cannot be negative');
        Price::fromPennyAmount(-1, 'EUR');
    }
}
<?php

namespace App\Tests\FirstModule\Domain\ValueObject;

use App\FirstModule\Domain\ValueObject\Price;
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
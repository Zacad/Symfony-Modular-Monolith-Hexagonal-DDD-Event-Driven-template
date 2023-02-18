<?php

namespace App\Tests\Common\ValueObject;

use App\Common\ValueObject\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMoneyIsEqual(): void
    {
        $money = Money::fromFloatAmount(10.0, 'EUR');
        $money2 = Money::fromFloatAmount(10.0, 'EUR');

        $this->assertTrue($money->isEqualTo($money2));
    }
}
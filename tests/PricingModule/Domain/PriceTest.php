<?php

namespace App\Tests\PricingModule\Domain;

use App\Common\ValueObject\Money;
use App\PricingModule\Domain\Entity\Price;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PriceTest extends TestCase
{
    public function testItCreatePrice(): void
    {
        $id = Uuid::uuid4();
        $sku = 'sku';
        $priceList = 'priceList';
        $price = Money::fromFloatAmount(
            amount: 100,
            currency: 'PLN',
        );

        $price = new Price(
            id: $id,
            sku: $sku,
            priceList: $priceList,
            price: $price,
        );

        $this->assertInstanceOf(Price::class, $price);
        $this->assertSame($sku, $price->getSku());
        $this->assertSame($priceList, $price->getPriceList());
        $this->assertTrue($price->getPrice()->isEqualTo(Money::fromFloatAmount(100, 'PLN')));
    }

    public function testItFailOnNegativePrice()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Price must be greater than 0');

        $id = Uuid::uuid4();
        $sku = 'sku';
        $priceList = 'priceList';
        $price = Money::fromFloatAmount(
            amount: -100,
            currency: 'PLN',
        );

        new Price(
            id: $id,
            sku: $sku,
            priceList: $priceList,
            price: $price,
        );
    }

    public function testItFailOnZeroPrice()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Price must be greater than 0');

        $id = Uuid::uuid4();
        $sku = 'sku';
        $priceList = 'priceList';
        $price = Money::fromFloatAmount(
            amount: 0,
            currency: 'PLN',
        );

        new Price(
            id: $id,
            sku: $sku,
            priceList: $priceList,
            price: $price,
        );
    }
}
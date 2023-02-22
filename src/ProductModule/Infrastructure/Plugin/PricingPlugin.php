<?php

namespace App\ProductModule\Infrastructure\Plugin;

use App\ProductModule\Domain\Plugin\PricingPluginInterface;

class PricingPlugin implements PricingPluginInterface
{

    public function findPricesForProduct(string $sku): iterable
    {
        return [];
    }
}
<?php

namespace App\ProductModule\Domain\Plugin;

interface PricingPluginInterface
{
    public function findPricesForProduct(string $sku): iterable;

}
<?php

namespace App\ProductModule\Infrastructure\Plugin;

use App\Common\Bus\Query\QueryBusInterface;
use App\PricingModule\Presentation\Query\FindPricesForProductQuery;
use App\ProductModule\Domain\Plugin\PricingPluginInterface;

class PricingPlugin implements PricingPluginInterface
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    public function findPricesForProduct(string $sku): iterable
    {
        return $this->queryBus->query(new FindPricesForProductQuery($sku));
    }
}
<?php

namespace App\PricingModule\Presentation\Query;

use App\Common\Bus\Query\AbstractQuery;

class FindPricesForProductQuery extends AbstractQuery
{
    public function __construct(
        public readonly string $sku,
    ) {
    }

}
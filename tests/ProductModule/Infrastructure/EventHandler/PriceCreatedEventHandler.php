<?php

namespace App\Tests\ProductModule\Infrastructure\EventHandler;

use App\ProductModule\ReadModel\ProductReadModel;
use App\Tests\PricingModule\Event\PriceCreatedEvent;

#[AsMessageHandler]
class PriceCreatedEventHandler
{

    public function __construct(
        private readonly ProductReadModel $productReadModel,
    ) {
    }

    public function __invoke(PriceCreatedEvent $event): void
    {
        $this->productReadModel->updatePrice($event->sku, $event->price, $event->priceList);
    }
}
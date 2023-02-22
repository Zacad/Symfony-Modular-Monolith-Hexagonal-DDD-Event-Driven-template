<?php

namespace App\ProductModule\Infrastructure\EventHandler;

use App\ProductModule\Presentation\ReadModel\ProductReadModel;
use App\Tests\PricingModule\Event\PriceCreatedEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

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
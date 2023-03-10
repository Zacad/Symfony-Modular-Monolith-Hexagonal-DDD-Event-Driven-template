<?php

namespace App\ProductModule\Presentation\ReadModel;

use App\Common\ValueObject\Money;
use App\ProductModule\Domain\Plugin\PricingPluginInterface;
use App\ProductModule\Domain\Repository\ProductRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class ProductReadModel
{
    private array $productViews = [];

    public function __construct(
        private readonly ProductRepositoryInterface $exampleOneRepository,
        private readonly PricingPluginInterface $pricingPlugin,
    ) {
    }

    public function init(): void
    {
        $products = $this->exampleOneRepository->findAll();

        foreach ($products as $product) {
            $this->productViews[$product->getSku()] = [
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'prices' => []
            ];
        }
    }


    public function createView(UuidInterface $id): void
    {
        $product = $this->exampleOneRepository->findById($id);

        $this->productViews[$product->getSku()] = [
            'id' => $product->getId(),
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'prices' => []
        ];

        $prices = $this->pricingPlugin->findPricesForProduct($product->getSku());

        foreach ($prices as $price) {
            $this->productViews[$product->getSku()]['prices'][$price->priceList] = $price->price;
        }
    }

    public function updatePrice(string $sku, Money $price, string $priceList)
    {
        $this->productViews[$sku]['prices'][$priceList] = $price;
    }

    public function getProductView(string $sku): array
    {
        return $this->productViews[$sku];
    }
}
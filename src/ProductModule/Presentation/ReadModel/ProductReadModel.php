<?php

namespace App\ProductModule\Presentation\ReadModel;

use App\Common\Bus\Query\QueryBusInterface;
use App\Common\ValueObject\Money;
use App\PricingModule\Presentation\Query\FindPricesForProductQuery;
use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class ProductReadModel
{
    private array $productViews = [];

    public function __construct(
        private readonly ExampleOneRepositoryInterface $exampleOneRepository,
        private readonly QueryBusInterface $queryBus
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

        $prices = $this->queryBus->query(new FindPricesForProductQuery($product->getSku()));

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
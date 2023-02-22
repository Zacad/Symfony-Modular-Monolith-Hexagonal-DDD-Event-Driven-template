<?php

namespace App\ProductModule\Presentation\ReadModel;

use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class ProductReadModel
{
    private array $productViews = [];

    public function __construct(
        private readonly ExampleOneRepositoryInterface $exampleOneRepository,
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


//        $json = $this->serializer->serialize($exampleOne, 'json');
//        $this->defaultStorage->write('example-one/'.$id->toString().'.json', $json);
    }

    public function updatePrice(string $sku, \App\Common\ValueObject\Money $price, string $priceList)
    {
    }

    public function getProductView(string $sku): array
    {
        return $this->productViews[$sku];
    }
}
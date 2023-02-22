<?php

namespace App\PricingModule\Presentation\QueryHandler;

use App\PricingModule\Infrastructure\DTO\PriceDto;
use App\PricingModule\Presentation\Query\FindPricesForProductQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindPricesForProductQueryHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(FindPricesForProductQuery $query): iterable
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p')
            ->from('App\PricingModule\Domain\Entity\Price', 'p')
            ->where('p.sku = :sku')
            ->setParameter('sku', $query->sku);

        $prices = $qb->getQuery()->getResult();

        $pricesData = [];

        foreach ($prices as $price) {
            $pricesData[] = new PriceDto(
                $price->getSku(),
                $price->getPriceList(),
                $price->getPrice(),
            );
        }

        return $pricesData;
    }

}
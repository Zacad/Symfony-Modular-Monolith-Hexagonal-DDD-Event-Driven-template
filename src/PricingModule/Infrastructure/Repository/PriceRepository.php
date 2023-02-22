<?php

namespace App\PricingModule\Infrastructure\Repository;

use App\PricingModule\Domain\Entity\Price;
use App\PricingModule\Domain\Repository\PriceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class PriceRepository extends ServiceEntityRepository implements PriceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Price::class);
    }

    public function save(Price $price): void
    {
        $this->getEntityManager()->persist($price);
        $this->getEntityManager()->flush();
    }

    public function findById(UuidInterface $id): ?Price
    {
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.id = :id');
        $qb->setParameter('id', $id);
        $qb->setMaxResults(1);
        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }
}
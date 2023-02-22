<?php

namespace App\ProductModule\Infrastructure\Repository;

use App\ProductModule\Domain\Entity\Product;
use App\ProductModule\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $exampleOne): void
    {
        $this->getEntityManager()->persist($exampleOne);
        $this->getEntityManager()->flush();
    }

    public function findById(UuidInterface $id): ?Product
    {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere($qb->expr()->eq('e.id', ':id'))
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAll(): iterable
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->getQuery()->getResult();
    }
}
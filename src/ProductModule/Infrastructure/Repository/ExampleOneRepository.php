<?php

namespace App\ProductModule\Infrastructure\Repository;

use App\ProductModule\Domain\Entity\Product;
use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class ExampleOneRepository extends ServiceEntityRepository implements ExampleOneRepositoryInterface
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
}
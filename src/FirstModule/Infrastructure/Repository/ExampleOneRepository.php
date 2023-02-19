<?php

namespace App\FirstModule\Infrastructure\Repository;

use App\FirstModule\Domain\Entity\ExampleOne;
use App\FirstModule\Domain\Repository\ExampleOneRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class ExampleOneRepository extends ServiceEntityRepository implements ExampleOneRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExampleOne::class);
    }

    public function save(ExampleOne $exampleOne): void
    {
        $this->getEntityManager()->persist($exampleOne);
        $this->getEntityManager()->flush();
    }

    public function findById(UuidInterface $id): ?ExampleOne
    {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere($qb->expr()->eq('e.id', ':id'))
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
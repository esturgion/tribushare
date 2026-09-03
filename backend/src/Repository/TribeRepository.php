<?php

namespace App\Repository;

use App\Entity\Tribe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tribe>
 */
class TribeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tribe::class);
    }

    public function codeExists(int $code): bool
    {
        return null !== $this->createQueryBuilder('t')
            ->select('1')
            ->andWhere('t.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

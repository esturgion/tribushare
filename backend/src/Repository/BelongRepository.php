<?php

namespace App\Repository;

use App\Entity\Belong;
use App\Entity\Tribe;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Belong>
 */
class BelongRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Belong::class);
    }

    public function findByUserAndTribe(User $user, Tribe $tribe): ?Belong
    {
        return $this->findOneBy([
            'member' => $user,
            'tribe' => $tribe,
        ]);
    }
}

<?php

namespace App\Service;

use App\Entity\Belong;
use App\Entity\User;
use App\Repository\BelongRepository;
use App\Repository\TribeRepository;
use App\Service\Factory\BelongFactory;
use Doctrine\ORM\EntityManagerInterface;

class BelongService
{
    public function __construct(
        private TribeRepository $tribeRepository,
        private BelongRepository $belongRepository,
        private EntityManagerInterface $em,
        private BelongFactory $belongFactory,
    ) {
    }

    public function addUserToTribe(User $user, int $code): Belong
    {
        $tribe = $this->tribeRepository->findOneBy([
            'code' => $code,
        ]);

        if (!$tribe) {
            throw new \Exception('Code d\'invitation invalide.');
        }

        $existingBelong = $this->belongRepository->findByUserAndTribe($user,$tribe);

        if ($existingBelong) {
            throw new \Exception('Cet utilisateur appartient déjà à cette tribe.');
        }

        $belong = $this->belongFactory->createMember($user, $tribe);

        $this->em->persist($belong);
        $this->em->flush();

        return $belong;
    }

}

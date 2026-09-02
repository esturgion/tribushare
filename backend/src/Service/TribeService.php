<?php

namespace App\Service;

use App\Dto\CreateTribeDto;
use App\Entity\Tribe;
use App\Entity\User;
use App\Mapper\TribeMapper;
use App\Repository\TribeRepository;
use App\Service\Factory\BelongFactory;
use Doctrine\ORM\EntityManagerInterface;

class TribeService
{
    public function __construct(
        private TribeMapper $mapper,
        private TribeRepository $tribeRepository,
        private EntityManagerInterface $em,
        private BelongFactory $belongFactory,
    ) {
    }

    public function create(CreateTribeDto $dto): Tribe
    {
        $tribe = $this->mapper->fromCreateDto($dto);

        $tribe->setCode(
            $this->codeGenerator()
        );

        $user = $this->em
            ->getRepository(User::class)
            ->find(1);

        if (!$user) {
            throw new \RuntimeException('User with id 1 not found.');
        }

        $belong = $this->belongFactory->createOwner($user, $tribe);

        $this->em->persist($tribe);
        $this->em->persist($belong);

        $this->em->persist($tribe);
        $this->em->flush();

        return $tribe;
    }

    private function codeGenerator(): int
    {
        do {
            $code = random_int(100000, 999999);
        } while ($this->tribeRepository->codeExists($code));

        return $code;
    }
}

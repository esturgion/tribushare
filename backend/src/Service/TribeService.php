<?php

namespace App\Service;

use App\Dto\CreateTribeDto;
use App\Entity\Belong;
use App\Entity\Tribe;
use App\Entity\User;
use App\Enum\TribeRoleEnum;
use App\Mapper\TribeMapper;
use App\Repository\TribeRepository;
use Doctrine\ORM\EntityManagerInterface;

class TribeService
{
    public function __construct(
        private TribeMapper $mapper,
        private TribeRepository $tribeRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function create(CreateTribeDto $dto): Tribe
    {
        $tribe = $this->mapper->fromCreateDto($dto);

        $tribe->setCode(
            $this->codeGenerator()
        );

        $user = $this->entityManager
            ->getRepository(User::class)
            ->find(1);

        if (!$user) {
            throw new \RuntimeException('User with id 1 not found.');
        }

        $belong = new Belong();
        $belong->setMember($user);
        $belong->setTribe($tribe);
        $belong->setUserStatus(TribeRoleEnum::OWNER);

        $this->entityManager->persist($tribe);
        $this->entityManager->persist($belong);

        $this->entityManager->persist($tribe);
        $this->entityManager->flush();

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

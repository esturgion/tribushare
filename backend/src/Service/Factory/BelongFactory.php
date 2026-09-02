<?php

namespace App\Service\Factory;

use App\Entity\Belong;
use App\Entity\Tribe;
use App\Entity\User;
use App\Enum\TribeRoleEnum;

class BelongFactory
{
    public function createMember(User $user, Tribe $tribe): Belong
    {
        $belong = new Belong();

        $belong->setMember($user);
        $belong->setTribe($tribe);
        $belong->setUserStatus(TribeRoleEnum::MEMBER);

        return $belong;
    }

    public function createOwner(User $user, Tribe $tribe): Belong
    {
        $belong = new Belong();

        $belong->setMember($user);
        $belong->setTribe($tribe);
        $belong->setUserStatus(TribeRoleEnum::OWNER);

        return $belong;
    }
}

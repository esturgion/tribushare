<?php

namespace App\Tests;

use App\Entity\Belong;
use App\Entity\Tribe;
use App\Entity\User;
use App\Enum\TribeRoleEnum;
use App\Service\Factory\BelongFactory;
use PHPUnit\Framework\TestCase;

class BelongFactoryTest extends TestCase
{
    public function testCreateMember(): void
    {
        $user = new User();
        $tribe = new Tribe();

        $factory = new BelongFactory();

        $belong = $factory->createMember($user, $tribe);

        self::assertSame(
            TribeRoleEnum::MEMBER,
            $belong->getUserStatus()
        );
    }
    
    public function testCreateOwner(): void
    {
        $user = new User();
        $tribe = new Tribe();

        $factory = new BelongFactory();

        $belong = $factory->createOwner($user, $tribe);

        self::assertSame(
            TribeRoleEnum::OWNER,
            $belong->getUserStatus()
        );
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Tribe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TribeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tribe = new Tribe();
        $tribe->setName("fixtures");
        $tribe->setCode(123);

        $manager->persist($tribe);

        $manager->flush();
    }
}

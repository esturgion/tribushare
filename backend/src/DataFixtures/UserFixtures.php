<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setPseudo('testeur');
        $user->setName('Michel');
        $user->setSurname('Jean');
        $user->setMail('jean.michel@example.com');
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'password')
        );
        $user->setRole(['ROLE_USER']);

        $manager->persist($user);

        $user2 = new User();

        $user2->setPseudo('invité');
        $user2->setName('Pouce');
        $user2->setSurname('Tom');
        $user2->setMail('tom.pouce@example.com');
        $user2->setPassword(
            $this->passwordHasher->hashPassword($user2, 'password')
        );
        $user2->setRole(['ROLE_USER']);

        $manager->persist($user2);

        $manager->flush();
    }
}

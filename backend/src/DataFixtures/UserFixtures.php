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

        $manager->flush();
    }
}

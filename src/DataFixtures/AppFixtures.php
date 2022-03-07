<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $pwdEncoder)
    {
    }
    public function load(ObjectManager $manager): void

    {
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setPassword($this->pwdEncoder->hashPassword($admin));
        $admin->setRoles(['ROLE_ADMIN']);



        $manager->persiste('$admin');
        $manager->flush();
    }
}

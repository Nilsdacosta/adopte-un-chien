<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPassword)
    {
        $this->userPassword = $userPassword;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $admin1 = new Admin();
        $admin1->setEmail('admin1@gmail.fr');
        $admin1->setPassword($this->userPassword->hashPassword($admin1, 'adminpass'));


        $admin2 = new Admin();
        $admin2->setEmail('admin2@gmail.fr');
        $admin2->setPassword($this->userPassword->hashPassword($admin2, 'adminpass'));


        $manager->persist($admin1);
        $manager->persist($admin2) ;

        $manager->flush();
    }
}

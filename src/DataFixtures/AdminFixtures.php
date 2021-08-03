<?php


namespace App\DataFixtures;


use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    protected  $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $admin1 = new Admin();
        $admin1->setEmail('admin1@gmail.fr');
        $admin1->setPassword(
            $this->passwordHasher->hashPassword($admin1, 'admin1pass')
        );


        $admin2 = new Admin();
        $admin2->setEmail('admin2@gmail.fr');
        $admin2->setPassword(
            $this->passwordHasher->hashPassword($admin2, 'admin2pass')
        );


        $manager->persist($admin1);
        $manager->persist($admin2) ;

        $manager->flush();
    }

}
<?php


namespace App\DataFixtures;


use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $admin1 = new Admin();
        $admin1->setEmail('admin1@gmail.fr');
        $admin1->setPassword('admin1pass');


        $admin2 = new Admin();
        $admin2->setEmail('admin2@gmail.fr');
        $admin2->setPassword('admin2pass');


        $manager->persist($admin1);
        $manager->persist($admin2) ;

        $manager->flush();
    }

}
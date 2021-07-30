<?php


namespace App\DataFixtures;


use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $streets=['rue de la liberté', 'rue du Général de Gaulle', 'rue de la Paix', 'rue des Champs Elysées', 'rue de Breteuil', 'rue Saint-Isidore', 'due des rosiers', 'rue de la Charmille', 'rue de la Bouquetière', 'avenue des Frères Lumières', 'cours Albert Thomas', 'avenue Colette Besson'];
        $cities=['Le Mans', 'Lyon', 'Paris', 'Marseille', 'Cannes', 'Bourg en Bresse','Nantes', 'Lille', 'Hazebrouck', 'Bordeaux' ];

        for($i=0;$i<20;$i++){
            $address = new Address();
            $address->setCity($cities[array_rand($cities, 1)]);
            $address->setStreet($streets[array_rand($streets, 1)]);
            $address->setZipcode(rand(10000, 89000));
            $address->setNumber(rand(1, 150));
            $manager->persist($address);
        }
        $manager->flush();
    }
}
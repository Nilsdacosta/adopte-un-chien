<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $breeds = ['Berger Allemand', 'Malinois', 'Fox Terrier', 'Epagneul', 'Autre', 'Caniche', 'Labrador', 'Bichon', 'Border Collie'];
        foreach ($breeds as $item) {
            $breed = new Breed();
            $breed->setName($item);
            $manager->persist($breed);
        }
        $manager->flush();
    }
}

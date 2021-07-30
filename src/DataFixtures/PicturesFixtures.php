<?php


namespace App\DataFixtures;


use App\Entity\Picture;
use App\Repository\DogRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PicturesFixtures extends Fixture implements DependentFixtureInterface
{
protected $dogRepository;

public function __construct(DogRepository $dogRepository)
{
    $this->dogRepository = $dogRepository;
}

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $dogs= $this->dogRepository->findAll();


    for($i=0;$i<10;$i++){
        $randNb = rand(0, count($dogs)-1 );
        $img = new Picture();
        $img->setDog($dogs[$randNb]);
        $img->setPath('../docs/img/'.$i.'.jpg');
        $manager->persist($img);
    }
    $manager->flush();
    }

    public function getDependencies()
    {
        return [DogFixtures::class];
    }
}
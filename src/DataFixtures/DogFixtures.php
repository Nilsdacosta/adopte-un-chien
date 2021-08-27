<?php

namespace App\DataFixtures;

use App\Entity\Announcer;
use App\Entity\Dog;
use App\Repository\AdvertisementRepository;
use App\Repository\AnnouncerRepository;
use App\Repository\BreedRepository;
use App\Repository\PictureRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class DogFixtures extends Fixture implements DependentFixtureInterface
{
    protected  $breedRepository;
    protected  $advertisementRepository;

    public function __construct(BreedRepository $breedRepository, AdvertisementRepository $advertisementRepository)
    {
        $this->breedRepository = $breedRepository;

        $this->advertisementRepository = $advertisementRepository;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $breeds = $this->breedRepository->findAll();

        $ads = $this->advertisementRepository->findAll();


        $names=["Aardvark",
    "Albatross",
    "Alligator",
    "Alpaca",
    "Ant",
    "Anteater",
    "Antelope",
    "Ape",
    "Armadillo",
    "Donkey",
    "Baboon",
    "Badger",
    "Barracuda",
    "Bat",
    "Bear",
    "Beaver",
    "Bee",
    "Bison",
    "Boar",
    "Buffalo",
    "Butterfly",
    "Camel",
    "Capybara",
    "Caribou",
    "Cassowary",
    "Cat",
    "Caterpillar",
    "Cattle",
    "Chamois",
    "Cheetah",
    "Chicken",
    "Chimpanzee",
    "Chinchilla",
    "Chough",
    "Clam",
    "Cobra",
    "Cockroach",
    "Cod",
    "Cormorant",
    "Coyote",
    "Crab",
    "Crane",
    "Crocodile",
    "Crow",
    "Curlew",
    "Deer",
    "Dinosaur",
    "Dog",
    "Dogfish",];

        foreach ($ads as $item) {
            $randNb = rand(0, count($names)-1);
            $randNb2 = rand(0, count($breeds)-1);
            $date = new \DateTime(date("Y-m-d", mt_rand(strtotime('2015-01-01'), strtotime('2021-07-01'))));
            $dog = new Dog();
            $dog->setAdvertisement($item);
            $dog->setName($names[$randNb]);
            $dog->setAcceptCats((bool)rand(0, 1));
            $dog->setAcceptDogs((bool)rand(0, 1));
            $dog->setDateOB($date);
            $dog->setHistory('"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
            $dog->setIsAdopted((bool)rand(0, 1));
            $dog->setSex((bool)rand(0, 1));
            $dog->setLof((bool)rand(0, 1));
            $dog->addBreed($breeds[$randNb2]);
            $manager->persist($dog);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [BreedFixtures::class, AdvertisementFixtures::class];
    }
}

<?php


namespace App\DataFixtures;


use App\Entity\Advertisement;
use App\Entity\Request;
use App\Repository\AdopterRepository;
use App\Repository\AdvertisementRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RequestFixtures extends Fixture implements DependentFixtureInterface
{
protected $advertisementRepository;
protected $adopterRepository;

public function __construct(AdvertisementRepository $advertisementRepository, AdopterRepository $adopterRepository)
{
    $this->adopterRepository = $adopterRepository;
    $this->advertisementRepository = $advertisementRepository;
}

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $adopters=$this->adopterRepository->findAll();
        $ads=$this->advertisementRepository->findAll();



        $request1 = new Request();
        $request1->setAdopter($adopters[rand(0, count($adopters)-1 )]);
        $request1->setAdvertisement($ads[rand(0, count($ads)-1 )]);
        $request1->setDateOfRequest(new \DateTime('05/04/2021'));

        $request2 = new Request();
        $request2->setAdopter($adopters[rand(0, count($adopters)-1 )]);
        $request2->setAdvertisement($ads[rand(0, count($ads)-1 )]);
        $request2->setDateOfRequest(new \DateTime('07/08/2021'));

        $request3 = new Request();
        $request3->setAdopter($adopters[rand(0, count($adopters)-1 )]);
        $request3->setAdvertisement($ads[rand(0, count($ads)-1 )]);
        $request3->setDateOfRequest(new \DateTime('09/262021'));

        $manager->persist($request1);
        $manager->persist($request2);
        $manager->persist($request3);
        $manager->flush();
    }

    public function getDependencies()
    {
       return [AdvertisementFixtures::class, AdopterFixtures::class];
    }
}
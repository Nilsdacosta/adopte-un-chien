<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use App\Repository\AnnouncerRepository;
use App\Repository\BreedRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AdvertisementFixtures extends Fixture implements DependentFixtureInterface
{
    protected $announcerRepository;
    protected $breedRepository;

    public function __construct(AnnouncerRepository $announcerRepository, BreedRepository $breedRepository)
    {
        $this->announcerRepository =$announcerRepository;
        $this->breedRepository = $breedRepository;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $announcers= $this->announcerRepository->findAll();
        $breeds = $this->breedRepository->findAll();


        for ($i=0;$i<35;$i++) {
            $date = new DateTime(date("Y-m-d", mt_rand(strtotime('2021-01-01'), strtotime('2021-07-01'))));
            $randNb = rand(0, count($announcers)-1);
            $randNb2 = rand(0, count($breeds)-1);
            $ad = new Advertisement();
            $ad->setAnnouncer($announcers[$randNb]);
            $ad->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ');
            $ad->setTitle($breeds[$randNb2]->getName().' à adopter ! ');
            $ad->setIsActive((bool)rand(0, 1));
            $ad->setUpdateDate($date);
            $manager->persist($ad);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [AnnouncerFixtures::class, BreedFixtures::class];
    }
}

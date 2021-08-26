<?php

namespace App\DataFixtures;

use App\Repository\RequestRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Message;
use Exception;

class MessageFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture implements DependentFixtureInterface
{
    protected $requestRepository;

    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $requests = $this->requestRepository->findAll();

        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';


        for ($i=0;$i<10;$i++) {
            $date = new \DateTime(date("Y-m-d", mt_rand(strtotime('2021-01-01'), strtotime('2021-07-01'))));
            $randNb = rand(0, count($requests)-1);
            $message = new Message();
            $message->setContent($content);
            $message->setRequest($requests[$randNb]);
            $message->setDateOfSending($date);
            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [RequestFixtures::class];
    }
}

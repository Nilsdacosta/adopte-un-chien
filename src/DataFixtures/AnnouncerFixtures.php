<?php

namespace App\DataFixtures;

use App\Entity\Announcer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\AddressRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AnnouncerFixtures extends Fixture implements DependentFixtureInterface
{
    protected $addressRepository;
    protected $categoryRepository;
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPassword;

    public function __construct(AddressRepository $addressRepository, CategoryRepository $categoryRepository, UserPasswordHasherInterface $userPassword)
    {
        $this->addressRepository = $addressRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userPassword = $userPassword;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $names=['Larry',
            'Lisa',
            'Lee',
            'Leslie',
            'Michelle',
            'Marco',
            'Mindy',
            'Maria',
            'Michael',
            'Noel',
            'Nana',
            'Nicholas',
            'Nicole',
            'Nate',
            'Nadine',
            'Olga',
            'Omar',
            'Odette',
            'Otto',
            'Ophelia',
            'Oscar',
            'Pablo',
            'Paloma',
            'Peter',
            'Paula',
            'Philippe',
            'Patty',
            'Rebekah',
            'Rene',
            'Rose',
            'Richard',
            'Rita',
            'Rafael',
            'Sebastien',
            'Sally',
            'Sam',
            'Shary',
            'Stan',
            'Sandy',
            'Tanya',
            'Teddy',
            'Teresa',
            'Tomas',
            'Tammy',
            'Tony',
            'Van',
            'Vicky',
            'Victor',
            'Virginie',
            'Vince',
            'Valerie',
            'Wendy',
            'Wilfred',
            'Wanda',
            'Walter',
            'Wilma',
            'William',
            'Kumiko',
            'Aki',
            'Miharu',
            'Chiaki',
            'Michiyo',
            'Itoe',];
        $addresses = $this->addressRepository->findAll();

        $categories = $this->categoryRepository->findAll();

        for ($i=1; $i<25;$i++) {
            $randNb = rand(0, count($addresses)-1);
            $randNb2 = rand(0, count($categories)-1);
            $announcer = new Announcer();
            $announcer->setAddress($addresses[$randNb]);
            $announcer->setName($names[$i]);
            $announcer->setPassword($this->userPassword->hashPassword($announcer, $announcer->getName().'pass'));
            $announcer->setEmail($announcer->getName().'@yahoo.fr');
            $announcer->setCategory($categories[$randNb2]);
            $announcer->setDescription('"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."');
            $manager->persist($announcer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [AddressFixtures::class, CategoryFixtures::class];
    }
}

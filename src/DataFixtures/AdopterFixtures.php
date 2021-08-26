<?php

namespace App\DataFixtures;

use App\Entity\Adopter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\AddressRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdopterFixtures extends Fixture implements DependentFixtureInterface
{
    protected $addressRepository;
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPassword;

    public function __construct(AddressRepository $addressRepository, UserPasswordHasherInterface $userPassword)
    {
        $this->addressRepository = $addressRepository;
        $this->userPassword = $userPassword;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $firstnames = ['Allison',
            'Arthur',
            'Ana',
            'Alex',
            'Arlene',
            'Alberto',
            'Barry',
            'Bertha',
            'Bill',
            'Bonnie',
            'Bret',
            'Beryl',
            'Chantal',
            'Cristobal',
            'Claudette',
            'Charley',
            'Cindy',
            'Chris',
            'Dean',
            'Dolly',
            'Danny',
            'Danielle',
            'Dennis',
            'Debby',
            'Erin',
            'Edouard',
            'Erika',
            'Earl',
            'Emily',
            'Ernesto',
            'Felix',
            'Fay',
            'Fabian',
            'Frances',
            'Franklin',
            'Florence',
            'Gabielle',
            'Gustav',
            'Grace',
            'Gaston',
            'Gert',
            'Gordon',
            'Humberto',
            'Hanna',
            'Henri',
            'Hermine',
            'Harvey', 'Laure', 'Mael', 'Nina', 'Maurice', 'Hubert'];
        $addresses = $this->addressRepository->findAll();
        $names = ['Abbott',
            'Acevedo',
            'Acosta',
            'Adams',
            'Adkins',
            'Aguilar',
            'Aguirre',
            'Albert',
            'Alexander',
            'Alford',
            'Allen',
            'Allison',
            'Alston',
            'Alvarado',
            'Alvarez',
            'Anderson',
            'Andrews',
            'Anthony',
            'Armstrong',
            'Arnold',
            'Ashley',
            'Atkins',
            'Atkinson',
            'Austin',
            'Avery',
            'Avila',
            'Ayala',
            'Ayers',
            'Bailey',
            'Baird',
            'Baker',
            'Baldwin',
            'Ball',
            'Ballard',
            'Banks',
            'Barber',
            'Barker',
            'Barlow',
            'Barnes',
            'Barnett',
            'Barr',
            'Barrera',
            'Barrett',
            'Barron',
            'Barry',
            'Bartlett',
            'Barton',
            'Bass', 'Da Costa', 'SaintGeorges', 'Hermant', 'Poirier', 'Ragot'];

        for ($i = 0; $i < 50; $i++) {
            $randNb = rand(0, count($addresses)-1);
            $adopter = new Adopter();
            $adopter->setName($names[$i]);
            $adopter->setFirstname($firstnames[$i]);
            $adopter->setEmail($adopter->getName() . '@gmail.com');
            $adopter->setPassword($this->userPassword->hashPassword($adopter, $adopter->getFirstname(). 'pass'));
            $adopter->setAddress($addresses[$randNb]);
            $manager->persist($adopter);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [AddressFixtures::class];
    }
}

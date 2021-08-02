<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Repository\AdvertisementRepository;
use App\Repository\DogRepository;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdvertisementRepository $advertisementRepository, DogRepository $dogRepository, PictureRepository $pictureRepository): Response
    {
        // Array of advertisement for view
        // $adsArray = [];
        $advertisements = $advertisementRepository->findLastFiveAds();
        // foreach ($advertisements as $ads){
        //     $dogs = $dogRepository->findByExampleField($ads->getId());
        //     foreach ($dogs as $dog) {
        //         $pictures = $pictureRepository->findByExampleField($dog->getId());
        //         foreach ($pictures as $picture) {
        //             // $dog n'est pas reconnu
        //             $dog->addPicture($picture);
        //         }
        //         $ads->addDog($dog);
        //     }
        //     array_push($adsArray, $ads);
        // }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'advertisements' => $advertisements
            // 'advertisements' => $adsArray
        ]);
    }
}

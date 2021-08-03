<?php

namespace App\Controller;


use App\Repository\AdvertisementRepository;
use App\Repository\AnnouncerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdvertisementRepository $advertisementRepository, AnnouncerRepository $announcerRepository): Response
    {
        $user = $this->getUser();
        // dd($this->getUser()->getRoles());
        $advertisements = $advertisementRepository->findLastFiveAds();
        $announcers = $announcerRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'advertisements' => $advertisements,
            'announcers' => $announcers,
            'user' => $user
        ]);
    }
}

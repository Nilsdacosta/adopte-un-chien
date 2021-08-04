<?php

namespace App\Controller;


use App\Repository\AdvertisementRepository;
use App\Repository\AnnouncerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdvertisementRepository $advertisementRepository, AnnouncerRepository $announcerRepository): Response
    {
        $advertisements = $advertisementRepository->findLastFiveAds();
        $announcers = $announcerRepository->findAll();
        return $this->render('home/index.html.twig', [
            'advertisements' => $advertisements,
            'announcers' => $announcers
        ]);
    }
}

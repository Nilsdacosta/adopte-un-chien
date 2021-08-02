<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Repository\AdvertisementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Loader\ParamConfigurator;

class AdvertisementController extends AbstractController
{
    /**
     * @Route("/advertisements", name="advertisements")
     */
    public function index(): Response
    {
        return $this->render('advertisement/index.html.twig', [
            'controller_name' => 'AdvertisementController'
        ]);
    }

    /**
     * @Route("/advertisement/{id}", requirements={'id'= "\d+"}, name="show_advertisement")
     */
    public function advertisement(int $id, AdvertisementRepository $advertisementRepository): Response
    {
        $advertisement = $advertisementRepository->findOneBy($id);
        return $this->render('advertisement/show_advertisement.html.twig', [
            'advertisement' => $advertisement
        ]);
    }
}

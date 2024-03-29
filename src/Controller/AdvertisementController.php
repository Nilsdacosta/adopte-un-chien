<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Entity\Announcer;
use App\Form\AdvertisementType;
use App\Repository\AdvertisementRepository;
use App\Repository\AnnouncerRepository;
use App\Repository\RequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/advertisement")
 */
class AdvertisementController extends AbstractController
{
    /**
     * @Route("/", name="advertisement_index", methods={"GET"})
     * @param AdvertisementRepository $advertisementRepository
     * @return Response
     */
    public function index(AdvertisementRepository $advertisementRepository): Response
    {

        return $this->render('advertisement/index.html.twig', [
            'advertisements' => $advertisementRepository->findByActiveAds(),
        ]);
    }

    /**
     * @Route("/new/", name="advertisement_new", methods={"GET","POST"})
     * @param Request $request
     * @IsGranted("ROLE_ANNOUNCER")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $advertisement = new Advertisement();
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $advertisement->setAnnouncer($this->getUser());
            $entityManager->persist($advertisement);
            $entityManager->flush();

            return $this->redirectToRoute('advertisement_announcer', ['id'=>$advertisement->getAnnouncer()->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('advertisement/new.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="advertisement_announcer", methods={"GET"})
     * @param Announcer $announcer
     * @param AdvertisementRepository $advertisementRepository
     * @return Response
     */

    public function filterAnnouncer(AdvertisementRepository $advertisementRepository, Announcer $announcer) : Response
    {
        return $this->render('advertisement/index.html.twig', [
            'advertisements' => $advertisementRepository->findBy(['announcer' => $announcer]),
            'announcer' => $announcer,
        ]);
    }


    /**
     * @Route("/{id}/show", name="advertisement_show", methods={"GET"})
     * @param RequestRepository $requestRepository
     * @param AdvertisementRepository $advertisementRepository
     * @param int $id
     * @return Response
     */
    public function show(RequestRepository $requestRepository, AdvertisementRepository $advertisementRepository, int $id): Response
    {
        $ad = $advertisementRepository->find($id);
        $announcer = $ad->getAnnouncer();
        $activeAds = [];
        $adopter = $this->getUser();
        $canRequest = $requestRepository->findOneBy(['adopter'=>$adopter, 'advertisement' =>$ad]);

        foreach ($announcer->getAdvertisements() as $item1){
            if($item1->getIsActive() == 1){
                array_push($activeAds, $item1);
            }
        };
        $dogs = [];
        foreach($activeAds as $item){
            foreach ($item->getDogs() as $dog){
                if($dog->getIsAdopted() == 0){
                    array_push($dogs, $dog);
                }
            }
        }

        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $ad,
            'activeAds' =>count($activeAds),
            'nbDogs' => count($dogs) ,
            'map' => '../docs/img/map.png',
            'canRequest'=>$canRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advertisement_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Advertisement $advertisement
     * @return Response
     * @IsGranted("ROLE_ANNOUNCER")
     */
    public function edit(Request $request, Advertisement $advertisement): Response
    {


        if ($this->getUser() == $advertisement->getAnnouncer()) {
            $form = $this->createForm(AdvertisementType::class, $advertisement);
            $form->handleRequest($request);
            $verif = 0;
            if ($form->isSubmitted() && $form->isValid()) {
                foreach ($advertisement->getDogs() as $dog) {
                    if ($dog->getIsAdopted() == true) {
                        $verif += 1;
                    }

                }

                if ($verif == sizeof($advertisement->getDogs()) ) {
                    $advertisement->setIsActive(false);
                }
                $advertisement->setUpdateDate(new \DateTime('now'));
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('advertisement_announcer', ['id'=>$this->getUser()->getID()], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('advertisement/edit.html.twig', [
                'advertisement' => $advertisement,
                'form' => $form,
            ]);
        }else {
            return $this->redirectToRoute('advertisement_index');
        }
    }

    /**
     * @Route("/{id}/delete", name="advertisement_delete", methods={"POST"})
     * @param Request $request
     * @param Advertisement $advertisement
     * @return Response
     * @IsGranted("ROLE_ANNOUNCER")
     */
    public function delete(Request $request, Advertisement $advertisement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertisement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advertisement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advertisement_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Announcer;
use App\Form\AnnouncerType;
use App\Repository\AnnouncerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/announcer")
 */
class AnnouncerController extends AbstractController
{
    /**
     * @Route("/", name="announcer_index", methods={"GET"})
     */
    public function index(AnnouncerRepository $announcerRepository): Response
    {
        return $this->render('announcer/index.html.twig', [
            'announcers' => $announcerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="announcer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $announcer = new Announcer();
        $form = $this->createForm(AnnouncerType::class, $announcer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($announcer);
            $entityManager->flush();

            return $this->redirectToRoute('announcer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('announcer/new.html.twig', [
            'announcer' => $announcer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="announcer_show", methods={"GET"})
     */
    public function show(Announcer $announcer): Response
    {
        $dogs = 0;
        $ads = $announcer->getAdvertisements();
        $activeAds = 0 ;
        $activeAdsArray = [];
        foreach ($ads as $ad){
            if (! $ad->getIsActive()) {
               $dogs += count($ad->getDogs());
            } else {
                array_push($activeAdsArray, $ad);
                $activeAds = count($activeAdsArray);
            }
        }

        return $this->render('announcer/show.html.twig', [
            'announcer' => $announcer,
            'dogs' => $dogs,
            'activeAdsArray' => $activeAdsArray,
            'activeAds' => $activeAds,
            'map' => '../docs/img/map.png',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="announcer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Announcer $announcer): Response
    {
        $form = $this->createForm(AnnouncerType::class, $announcer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('announcer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('announcer/edit.html.twig', [
            'announcer' => $announcer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="announcer_delete", methods={"POST"})
     */
    public function delete(Request $request, Announcer $announcer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announcer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($announcer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('announcer_index', [], Response::HTTP_SEE_OTHER);
    }
}

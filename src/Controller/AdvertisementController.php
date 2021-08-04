<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Entity\Announcer;
use App\Form\AdvertisementType;
use App\Repository\AdvertisementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnouncerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/advertisement")
 */
class AdvertisementController extends AbstractController
{
    /**
     * @Route("/", name="advertisement_index", methods={"GET"})
     */
    public function index(AdvertisementRepository $advertisementRepository): Response
    {

        return $this->render('advertisement/index.html.twig', [
            'advertisements' => $advertisementRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="advertisement_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ANNOUNCER")
     */
    public function new(Request $request): Response
    {
        $advertisement = new Advertisement();
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $advertisement->setAnnouncer($entityManager->getRepository(Announcer::class)->find(53));
            $entityManager->persist($advertisement);
            $entityManager->flush();

            return $this->redirectToRoute('advertisement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('advertisement/new.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="advertisement_announcer", methods={"GET"})
     */
    public function filterAnnouncer(int $id, AdvertisementRepository $advertisementRepository, AnnouncerRepository $announcerRepository) : Response
    {
        return $this->render('advertisement/index.html.twig', [
            'advertisements' => $advertisementRepository->findBy(['announcer'=>$id]),
            'announcer' => $announcerRepository->find($id)
    ]);
    }

    /**
     * @Route("/{id}", name="advertisement_show", methods={"GET"})
     */
    public function show(Advertisement $advertisement): Response
    {
        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advertisement_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ANNOUNCER")
     */
    public function edit(Request $request, Advertisement $advertisement): Response
    {
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advertisement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('advertisement/edit.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="advertisement_delete", methods={"POST"})
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

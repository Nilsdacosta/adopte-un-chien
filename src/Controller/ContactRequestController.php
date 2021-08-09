<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Advertisement;
use App\Entity\ContactRequest;
use App\Entity\Message;
use App\Form\ContactRequestType;
use App\Repository\RequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/request")
 */
class ContactRequestController extends AbstractController
{
    /**
     * @Route("/", name="contact_request_index", methods={"GET"})
     * @param RequestRepository $requestRepository
     * @return Response
     */
    public function index(RequestRepository $requestRepository): Response
    {
        return $this->render('contact_request/index.html.twig', [
            'contact_requests' => $requestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="contact_request_new", methods={"GET","POST"})
     * @param Request $request
     * @param Advertisement $ad
     * @return Response
     */
    public function new(Request $request, Advertisement $ad): Response
    {
        $contactRequest = new ContactRequest();
        $contactRequest->addMessage(new Message());
        $adopter = $this->getUser();
        $contactRequest->setAdopter($adopter);
        $contactRequest->setAdvertisement($ad);
        $form = $this->createForm(ContactRequestType::class, $contactRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactRequest);
            $entityManager->flush();

            return $this->redirectToRoute('advertisement_show', ['id'=>$ad->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_request/new.html.twig', [
            'contact_request' => $contactRequest,
            'form' => $form,
            'ad' => $ad,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_request_show", methods={"GET"})
     * @param ContactRequest $contactRequest
     * @return Response
     */
    public function show(ContactRequest $contactRequest): Response
    {
        return $this->render('contact_request/show.html.twig', [
            'contact_request' => $contactRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_request_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ContactRequest $contactRequest
     * @return Response
     */
    public function edit(Request $request, ContactRequest $contactRequest): Response
    {
        $form = $this->createForm(ContactRequestType::class, $contactRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_request/edit.html.twig', [
            'contact_request' => $contactRequest,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_request_delete", methods={"POST"})
     * @param Request $request
     * @param ContactRequest $contactRequest
     * @return Response
     */
    public function delete(Request $request, ContactRequest $contactRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_request_index', [], Response::HTTP_SEE_OTHER);
    }
}

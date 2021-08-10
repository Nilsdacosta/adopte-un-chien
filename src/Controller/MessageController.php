<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\AdvertisementRepository;
use App\Repository\MessageRepository;
use App\Repository\RequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactRequest;
use function PHPUnit\Framework\containsEqual;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     * @param RequestRepository $requestRepository
     * @return Response
     */
    public function index(RequestRepository $requestRepository): Response
    {
        $user = $this->getUser();

        if(in_array('ROLE_ADOPTER', $user->getRoles())){
            $requests = $requestRepository->findByAdopterFilterByDate($user);
        } else {
            $requests =$requestRepository->findByAnnouncerFilterByDate($user);

        }


        return $this->render('message/index.html.twig', [
            'requests'=>$requests,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}", name="message_show", methods={"GET", "POST"})
     * @param ContactRequest $contactRequest
     * @param Request $request
     * @return Response
     */
    public function show(ContactRequest $contactRequest,  Request $request): Response
    {
        foreach ($contactRequest->getMessages() as $mess){
            $mess->setIsRead(true);
            $this->getDoctrine()->getManager()->persist($mess);
        }
        $this->getDoctrine()->getManager()->flush();
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setRequest($contactRequest);
            $this->getDoctrine()->getManager()->persist($message);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_show', ['id'=>$contactRequest->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/show.html.twig', [
            'request' => $contactRequest,
            'form'=> $form->createView(),

        ]);
    }



}

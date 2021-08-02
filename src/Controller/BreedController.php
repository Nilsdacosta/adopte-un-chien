<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Form\BreedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BreedController extends AbstractController
{
    /**
     * @Route("/breed", name="breed")
     */
    public function index(): Response
    {
        return $this->render('breed/index.html.twig', [
            'controller_name' => 'BreedController',
        ]);
    }

    /**
     * @Route("/breed/new", name="breed_new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed, [
            'submit' => true
        ]);

        // On récupère les données du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($breed);
            $em->flush();
            // Pour eviter les F5
            return $this->redirectToRoute('breed_new');
        }
        return $this->render('breed/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

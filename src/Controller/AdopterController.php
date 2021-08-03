<?php

namespace App\Controller;

use App\Entity\Adopter;
use App\Form\AdopterType;
use App\Repository\AdopterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/adopter")
 */
class AdopterController extends AbstractController
{

    /**
     * @Route("/", name="adopter_index", methods={"GET"})
     */
    public function index(AdopterRepository $adopterRepository): Response
    {
        return $this->render('adopter/index.html.twig', [
            'adopters' => $adopterRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="adopter_new")
     */
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $adopter = new Adopter();

        // On crée le formulaire (objet de traitement)
        // Premier paramètre : le formulaire type (FQCN)
        // Deuxième paramètre : l'objet à manipuler (à synchroniser avec le formulaire)
        // Troisième paramètre : des options du formulaire
        $form = $this->createForm(AdopterType::class, $adopter, [
            'method' => 'POST',
            'action' => $this->generateUrl('adopter_new'),
        ]);

        // On dit explicitement au formulaire de traiter ce que contient la requête (objet Request)
        $form->handleRequest($request);

        // On regarde si le formulaire a été soumis ET est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On enregistre
            $adopter->setPassword($passwordHasher->hashPassword($adopter, $adopter->getPassword()));
            $em->persist($adopter);
            $em->flush();

            // Une fois que le formulaire est validé,
            // on redirige pour éviter que l'utilisateur ne recharge la page
            // et soumette la même information une seconde fois
            return $this->redirectToRoute('home');
        }

        return $this->render('adopter/new.html.twig', [
            'form' => $form->createView(), // On crée un objet FormView, qui sert à l'affichage de notre formulaire
        ]);
    }
}

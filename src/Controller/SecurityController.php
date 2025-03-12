<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LegoCollectionRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/security/login', name: 'lego_store_login')]
    public function login(AuthenticationUtils $authenticationUtils, LegoCollectionRepository $legoCollectionRepository): Response
    {
        // Récupère les potentielles erreurs de login
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier email saisi par l’utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();
        if (!$this->getUser()) {
            $collections = $legoCollectionRepository->findByPremium(false);
        } else {
            $collections = $legoCollectionRepository->findAll();
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'collections' => $collections,
            'error' => $error
        ]);
    }

    #[Route('/security/logout', name: 'lego_store_logout')]
    public function logout()
    {
        // Ce code ne sera *jamais* exécuté : 
        // le SecurityBundle intercepte la requête et gère la déconnexion
        throw new \LogicException('Cette méthode peut rester vide, '.
            'elle sera interceptée par la clé logout du firewall.');
    }

    

}

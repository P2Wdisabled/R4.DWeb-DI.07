<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lego;
use App\Entity\LegoCollection;
use App\Repository\LegoCollectionRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LegoRepository;

class LegoController extends AbstractController
{
#[Route('/', name: 'home')]
public function home(LegoRepository $legoRepository, LegoCollectionRepository $legoCollectionRepository): Response
{
    if (!$this->getUser()) {
        // Si l'utilisateur n'est pas connecté, on récupère uniquement les legos non premium
        $legos = $legoRepository->findByPremium(false);
        $collections = $legoCollectionRepository->findByPremium(false);
    } else {
        // Si connecté, on récupère tous les legos
        $legos = $legoRepository->findAll();
        $collections = $legoCollectionRepository->findAll();
    }

    return $this->render('lego.html.twig', [
        'legos'       => $legos,
        'collections' => $collections,
    ]);
}

    #[Route('/buy/{id}', name: 'buy')]
    public function buy(int $id): Response
    {
        return new Response("Achat du Lego avec l'ID : " . $id);
    }

    #[Route('/collections/{id}', name: 'filter')]
    public function filter(LegoCollection $collection, LegoCollectionRepository $legoCollectionRepository): Response 
    {
    //$collectionName = str_replace("_", " ", $collection);
    
    // Récupérer la collection par son nom
    //$legoCollection = $legoCollectionRepository->findOneBy(['name' => $collectionName]);
    if ($collection->isPremiumOnly() && !$this->getUser()) {
        // Rediriger ou throw 403
        return $this->redirectToRoute('lego_store_login');
    }

    if (!$collection) {
        throw $this->createNotFoundException("La collection '$collection' n'existe pas.");
    }

    // Récupérer les Legos associés à la collection
        $legos = $collection->getLegos();
        if (!$this->getUser()) {
            $collections = $legoCollectionRepository->findByPremium(false);
        } else {
            $collections = $legoCollectionRepository->findAll();
        }

    return $this->render('lego.html.twig', [
        'legos'       => $legos,
        'collections' => $collections,
    ]);
}


    #[Route('/test', name: 'test')]
    public function test(ManagerRegistry $doctrine): Response
    {
        // Id fictif si on a un constructeur paramétré
        $lego = new Lego(1234);
        $lego->setName("Un beau Lego");
        // $lego->setCollection("Lego Espace");
        $lego->setPrice(59.99);
        $lego->setDescription("le lego le moins chere du mon en proportion Kg/€");
        $lego->setPieces(49570);
        $lego->setBoxImage('LEGO_31062_Box.png');
        $lego->setLegoImage('LEGO_31062_Box.png');

        $em = $doctrine->getManager();
        $em->persist($lego);
        $em->flush();

        dd($lego);  // Affiche le contenu de l’objet pour vérification
    }

    

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LegoService;
use App\Entity\Lego;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LegoRepository;

class LegoController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(LegoRepository $legoRepository): Response
    {
        $legos = $legoRepository->findAll();

        // Passage de l'objet au template
        return $this->render('lego.html.twig', [
            'legos' => $legos,
        ]);
    }

    #[Route('/buy/{id}', name: 'buy')]
    public function buy(int $id): Response
    {
        return new Response("Achat du Lego avec l'ID : " . $id);
    }

    #[Route('/{collection}', name: 'filter_by_collection')]
    public function filter(string $collection, LegoRepository $legoRepository): Response
    {
        // Récupérer les Legos filtrés par collection
        $collection = str_replace("_"," ",$collection);
        $legos = $legoRepository->findBy(['collection' => $collection]);

        // Passer les Legos au template
        return $this->render('lego.html.twig', [
            'legos' => $legos,
        ]);
    }

    #[Route('/test', name: 'test')]
    public function test(ManagerRegistry $doctrine): Response
    {
        // Id fictif si on a un constructeur paramétré
        $lego = new Lego(1234);
        $lego->setName("Un beau Lego");
        $lego->setCollection("Lego Espace");
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

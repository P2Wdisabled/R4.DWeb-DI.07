<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LegoService;

class LegoController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(LegoService $legoService): Response
    {
        // Utilisation du service pour obtenir un objet Lego
        $legos = $legoService->getLegos();

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

    #[Route('/{collection}', name: 'filter_by_collection', requirements: ['collection' => 'creator|star_wars|creator_expert'])]
    public function filter(string $collection, LegoService $legoService): Response
    {
        // Récupérer les Legos filtrés par collection
        $collection = str_replace("_"," ",$collection);
        $legos = $legoService->getLegosByCollection($collection);

        // Passer les Legos au template
        return $this->render('lego.html.twig', [
            'legos' => $legos,
        ]);
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lego;

class LegoController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        // Création de l'objet Lego
        $lego = new Lego(
            10252,
            'La coccinelle Volkwagen',
            'Creator Expert'
        );

        // Hydratation des propriétés
        $lego->setDescription("Construis une réplique LEGO® Creator Expert de l'automobile la plus populaire au monde. Ce magnifique modèle LEGO est plein de détails authentiques qui capturent le charme et la personnalité de la voiture, notamment un coloris bleu ciel, des ailes arrondies, des jantes blanches avec des enjoliveurs caractéristiques, des phares ronds et des clignotants montés sur les ailes.");
        $lego->setPrice(94.99);
        $lego->setPieces(1167);
        $lego->setBoxImage('LEGO_10252_Box.png'); // Chemin relatif depuis le dossier public
        $lego->setLegoImage('LEGO_10252_Main.jpg');

        // Passage de l'objet au template
        return $this->render('lego.html.twig', [
            'lego' => $lego,
        ]);
    }

    #[Route('/buy/{id}', name: 'buy')]
    public function buy(int $id): Response
    {
        return new Response("Achat du Lego avec l'ID : " . $id);
    }
}

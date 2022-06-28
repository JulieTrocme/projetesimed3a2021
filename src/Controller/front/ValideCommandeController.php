<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopProduitCategorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ValideCommandeController extends AbstractController {

    public function commande(ManagerRegistry $doctrine, SessionInterface $session)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

        dd($session);
        if ($session->get('user')) {


            $idUser = $session->get('user');
            $commande = $doctrine
                ->getRepository(TShopCommande::class)
                ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);

            return $this->render('front/default/commande.html.twig', [
                'categories'=>$categories,
                'commande'=>$commande
            ]);
        } else {
            return $this->render('front/default/login.html.twig', [
                'categories'=>$categories,
                'error' => ''
            ]);
        }

    }

}
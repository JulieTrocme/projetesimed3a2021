<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopUser;
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

            $idUser = $this->getUser();

        $client = $doctrine
            ->getRepository(TShopUser::class)
            ->findOneBy(['uId'=>$idUser]);

            $commande = $doctrine
                ->getRepository(TShopCommande::class)
                ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);

            return $this->render('front/default/commande.html.twig', [
                'categories'=>$categories,
                'client'=>$client,
                'commande'=>$commande
            ]);

    }

}
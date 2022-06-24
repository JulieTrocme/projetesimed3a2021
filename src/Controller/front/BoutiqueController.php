<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopCommandeLigne;
use App\Entity\TShopProduit;
use App\Entity\TShopUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BoutiqueController extends AbstractController
{

    public function boutique()
    {

        return $this->render('front/default/produits.html.twig', [

        ]);
    }

    /**
     * @Route("/boutique/addPanier/{id}", name="addPanier")
     */
    public function addPanier(Request $request, ManagerRegistry $doctrine, int $id){
        $quantite = $request->request->get('quantite');
        $idUser = $this->get('session')->get('user');
        if($idUser == null){
            //créer user temp
            $user = new TShopUser();
            $doctrine->getManager()->persist($user);
            $doctrine->getManager()->flush();
            $idUser = $user->getUId();
            $this->get('session')->set('user',$idUser);
            //créer commande avec cet user
            $commande = new TShopCommande();
            $commande->setCdeCliId($idUser);
            $commande->setUser($user);
            $commande->setCdeEtatId(1);
            $commande->setCdeDate(new \DateTime());
            $doctrine->getManager()->persist($commande);
            $doctrine->getManager()->flush();
        }
        else{
            $user = $doctrine->getRepository(TShopUser::class)->findOneBy(['uId'=>$idUser]);
            $commande = $doctrine->getRepository(TShopCommande::class)->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);
            if($commande == null){
                $commande = new TShopCommande();
                $commande->setCdeCliId($idUser);
                $commande->setUser($user);
                $commande->setCdeEtatId(1);
                $commande->setCdeDate(new \DateTime());
                $doctrine->getManager()->persist($commande);
                $doctrine->getManager()->flush();
            }
        }
        $ligne = $doctrine->getRepository(TShopCommandeLigne::class)->findOneBy(['clCdeId'=>$commande->getCdeId(),'clArtId'=>$id]);
        $produit = $doctrine->getRepository(TShopProduit::class)->findOneBy(['prId'=>$id]);
        if($ligne == null){
            $ligne = new TShopCommandeLigne();
            $ligne->setClArtId($id);
            $ligne->setArticle($produit);
            $ligne->setClCdeId($commande->getCdeId());
            $ligne->setClMtn($produit->getPrPrix());
            $ligne->setClQte($quantite);
            $ligne->setCommande($commande);
            $doctrine->getManager()->persist($ligne);
            $doctrine->getManager()->flush();
        }
        else{
            $ligne->setClQte($ligne->getClQte() + $quantite);
            $doctrine->getManager()->flush();
        }

        return $this->redirectToRoute("panier");
    }
}
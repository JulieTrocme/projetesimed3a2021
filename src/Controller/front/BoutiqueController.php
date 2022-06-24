<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopCommandeLigne;
use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use App\Entity\TShopProduitMaison;
use App\Entity\TShopUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BoutiqueController extends AbstractController
{

    public function boutique(ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        $produits = $doctrine
            ->getRepository(TShopProduit::class)
            ->findAll();

        $catAfficher = $doctrine
            -> getRepository(TShopProduitCategorie::class)
            -> findAll();

        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits,
            'categories'=>$categories,
            'catAfficher'=>$catAfficher,
            'catActuel'=>null,
            'url1' => null,
            'url2' => null
        ]);
    }

    /**
     * @Route("/boutique/{cat}", name="boutiqueCat")
     */
    public function boutiqueCat(string $cat, ManagerRegistry $doctrine)
    {
        $catURL = $cat;
        $categorie = $doctrine
            -> getRepository(TShopProduitCategorie::class)
            -> findOneBy(['caSeoUrl'=>$catURL]);

        if ($categorie != null) {
            $produits = $doctrine
                ->getRepository(TShopProduit::class)
                ->findBy(['prIdCat1'=>$categorie->getCaId()]);

            $catAfficher = $doctrine
                -> getRepository(TShopProduitCategorie2::class)
                -> findBy(['caCatId' => $categorie->getCaId()]);
        } else {
            $categorieMaison = $doctrine
                -> getRepository(TShopProduitMaison::class)
                ->findOneBy(['pmLibelle' =>$catURL]);

            $produits = $doctrine
                ->getRepository(TShopProduit::class)
                ->findBy(['prIdMaison'=>$categorieMaison->getPmId()]);
            $catAfficher = $doctrine
                -> getRepository(TShopProduitCategorie::class)
                -> findAll();
        }

        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits,
            'categories'=>$categories,
            'catAfficher'=>$catAfficher,
            'catActuel'=>$categorie,
            'url1' => $catURL,
            'url2' => null
        ]);
    }


    /**
     * @Route("/boutique/{cat}/{sscat}", name="boutiqueSousCat")
     */
    public function boutiqueSousCat(string $cat, string $sscat, ManagerRegistry $doctrine)
    {
        $catURL = $cat;
        $sscatURL = $sscat;

        $sscategorie = $doctrine
            -> getRepository(TShopProduitCategorie2::class)
            -> findOneBy(['caSeoUrl'=>$sscatURL]);

        $produits = $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prIdCat2'=>$sscategorie->getCaId()]);
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits,
            'categories'=>$categories,
            'catAfficher'=>null,
            'catActuel'=>$sscategorie,
            'url1' => $catURL,
            'url2' => $sscatURL
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
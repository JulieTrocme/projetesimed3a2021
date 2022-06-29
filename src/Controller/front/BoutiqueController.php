<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopCommandeLigne;
use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use App\Entity\TShopProduitMaison;
use App\Entity\TShopUser;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BoutiqueController extends AbstractController
{

    public function boutique(Request $request, ManagerRegistry $doctrine,ProduitRepository $repository)
    {
        $search = $request->request->get('search');
        if($search == null) {
            $search = $request->query->get('search');
            if($search == null){
                $search = "";
            }
        }
        $page = $request->query->get('page');
        if($page == null) $page = 1;
        $prixMin = $request->request->get('prixMin');
        $prixMax = $request->request->get('prixMax');
        $tri = $request->request->get('tri');
        if($tri == null) {
            $tri = $request->query->get('tri');
            if($tri == null){
                $tri = 'order';
            }
        }
        $orderby = [];
        switch ($tri){
            case 'order':
                $orderby = ['prId' => 'DESC'];
                $sort = 't_shop_produit.prId';
                $order = 'DESC';
                break;
            case 'priceAsc':
                $orderby = ['prPrix' => 'ASC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'ASC';
                break;
            case 'priceDesc':
                $orderby = ['prPrix' => 'DESC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'DESC';
                break;
            case 'nameAsc':
                $orderby = ['prTitre' => 'ASC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'ASC';
                break;
            case 'nameDesc':
                $orderby = ['prTitre' => 'DESC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'DESC';
                break;
        }
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

        $produits = $repository->getProduitsPaginated($page,$sort, $order, 0, 0, 0, $search);
        $count = $repository->countPage(0, 0, 0, $search);
        if($count == 0) $count = 1;

        $catAfficher = $doctrine
            -> getRepository(TShopProduitCategorie::class)
            -> findAll();

        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits,
            'categories'=>$categories,
            'catAfficher'=>$catAfficher,
            'catActuel'=>null,
            'url1' => null,
            'url2' => null,
            'tri' => $tri,
            'prixMin' => $prixMin,
            'prixMax' => $prixMax,
            'count' => $count,
            'page' => $page,
            'search' => $search
        ]);
    }

    /**
     * @Route("/boutique/{cat}", name="boutiqueCat")
     */
    public function boutiqueCat(Request $request, string $cat, ManagerRegistry $doctrine,ProduitRepository $repository)
    {
        $page = $request->query->get('page');
        if($page == null) $page = 1;
        $prixMin = $request->request->get('prixMin');
        $prixMax = $request->request->get('prixMax');
        $tri = $request->request->get('tri');
        if($tri == null){
            $tri = 'order';
        }
        $orderby = [];
        switch ($tri){
            case 'order':
                $orderby = ['prId' => 'DESC'];
                $sort = 't_shop_produit.prId';
                $order = 'DESC';
                break;
            case 'priceAsc':
                $orderby = ['prPrix' => 'ASC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'ASC';
                break;
            case 'priceDesc':
                $orderby = ['prPrix' => 'DESC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'DESC';
                break;
            case 'nameAsc':
                $orderby = ['prTitre' => 'ASC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'ASC';
                break;
            case 'nameDesc':
                $orderby = ['prTitre' => 'DESC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'DESC';
                break;
        }
        $catURL = $cat;
        $categorie = $doctrine
            -> getRepository(TShopProduitCategorie::class)
            -> findOneBy(['caSeoUrl'=>$catURL]);

        if ($categorie != null) {
            $produits = $repository->getProduitsPaginated($page,$sort, $order,$categorie->getCaId());
            $count = $repository->countPage($categorie->getCaId());
            $catAfficher = $doctrine
                -> getRepository(TShopProduitCategorie2::class)
                -> findBy(['caCatId' => $categorie->getCaId()]);
        } else {
            $categorieMaison = $doctrine
                -> getRepository(TShopProduitMaison::class)
                ->findOneBy(['pmLibelle' =>$catURL]);
            $produits = $repository->getProduitsPaginated($page,$sort, $order,0,0,$categorieMaison->getPmId());
            $count = $repository->countPage(0,0,$categorieMaison->getPmId());
            if($count == 0) $count = 1;
            if($count == 0) $count = 1;
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
            'url2' => null,
            'tri' => $tri,
            'prixMin' => $prixMin,
            'prixMax' => $prixMax,
            'count' => $count,
            'page' => $page
        ]);
    }


    /**
     * @Route("/boutique/{cat}/{sscat}", name="boutiqueSousCat")
     */
    public function boutiqueSousCat(Request $request, string $cat, string $sscat, ManagerRegistry $doctrine,ProduitRepository $repository)
    {
        $page = $request->query->get('page');
        if($page == null) $page = 1;
        $prixMin = $request->request->get('prixMin');
        $prixMax = $request->request->get('prixMax');
        $tri = $request->request->get('tri');
        if($tri == null){
            $tri = 'order';
        }
        $orderby = [];
        switch ($tri){
            case 'order':
                $orderby = ['prId' => 'DESC'];
                $sort = 't_shop_produit.prId';
                $order = 'DESC';
                break;
            case 'priceAsc':
                $orderby = ['prPrix' => 'ASC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'ASC';
                break;
            case 'priceDesc':
                $orderby = ['prPrix' => 'DESC'];
                $sort = 't_shop_produit.prPrix';
                $order = 'DESC';
                break;
            case 'nameAsc':
                $orderby = ['prTitre' => 'ASC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'ASC';
                break;
            case 'nameDesc':
                $orderby = ['prTitre' => 'DESC'];
                $sort = 't_shop_produit.prTitre';
                $order = 'DESC';
                break;
        }
        $catURL = $cat;
        $sscatURL = $sscat;

        $sscategorie = $doctrine
            -> getRepository(TShopProduitCategorie2::class)
            -> findOneBy(['caSeoUrl'=>$sscatURL]);
        $produits = $repository->getProduitsPaginated($page,$sort, $order,0,$sscategorie->getCaId());
        $count = $repository->countPage(0,$sscategorie->getCaId());
        if($count == 0) $count = 1;
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits,
            'categories'=>$categories,
            'catAfficher'=>null,
            'catActuel'=>$sscategorie,
            'url1' => $catURL,
            'url2' => $sscatURL,
            'tri' => 'order',
            'prixMin' => $prixMin,
            'prixMax' => $prixMax,
            'count' => $count,
            'page' => $page
        ]);

    }

    /**
     * @Route("/addPanier/{id}", name="addPanier")
     */
    public function addPanier(Request $request, ManagerRegistry $doctrine, int $id){
        $quantite = $request->request->get('quantite');
        $user = $this->getUser();
        if($user != null) {
            $idUser = $user->getUId();
        }else{
            $idUser = $this->get('session')->get('user');
        }
        if($idUser == null){
            //créer user temp
            $user = new TShopUser();
            $user->setUIdRang(1);
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
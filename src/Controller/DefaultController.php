<?php

namespace App\Controller;

use App\Entity\TShopPays;
use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use App\Entity\TShopProduitMaison;
use App\Entity\TShopUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

    public function index(ManagerRegistry $doctrine)
    {
        $newProduit =  $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prNouveaux'=>1]);
        $popuProduit =  $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prPopu'=>1]);
        return $this->render('front/default/index.html.twig', [
            'newProduit'=>$newProduit,
            'popuProduit'=>$popuProduit
        ]);
    }

    public function boutique(ManagerRegistry $doctrine)
    {
        $produits = $doctrine
            ->getRepository(TShopProduit::class)
            ->findAll();
        return $this->render('front/default/produits.html.twig', [
            'produits'=>$produits
        ]);
    }

    public function produit(Request $request,ManagerRegistry $doctrine)
    {
        $produit = $doctrine
            ->getRepository(TShopProduit::class)
            ->findOneBy(['prId'=>$request->query->get('id')]);
        return $this->render('front/default/produit.html.twig', [
            'produit' => $produit,
        ]);
    }

    public function register()
    {
        return $this->render('front/default/register.html.twig', [

        ]);
    }

    public function contact()
    {
        return $this->render('front/default/contact.html.twig', [

        ]);
    }

    public function panier()
    {
        return $this->render('front/default/panier.html.twig', [

        ]);
    }

    public function membre(ManagerRegistry $doctrine)
    {
        $user = $doctrine
            ->getRepository(TShopUser::class)
            ->findOneBy(['uId'=>1]);

        $pays = $doctrine->getRepository(TShopPays::class)->findAll();

        return $this->render('front/default/membre.html.twig', [
            'user' => $user,
            'listepays' => $pays
        ]);
    }

    public function administrateur()
    {
        return $this->render('admin/login.html.twig', [

        ]);
    }

    public function admin_produit(ManagerRegistry $doctrine)
    {
        $produits = $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prArchive'=>0]);

        return $this->render('admin/admin_produit.html.twig', [
            'produits' => $produits,
        ]);
    }

    public function admin_categorie(ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

        return $this->render('admin/admin_categorie.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function admin_souscategorie(ManagerRegistry $doctrine)
    {
        $souscategories = $doctrine
            ->getRepository(TShopProduitCategorie2::class)
            ->findAll();

        return $this->render('admin/admin_souscategorie.html.twig', [
            'souscategories' => $souscategories,
        ]);
    }

    public function produit_add(Request $request,ManagerRegistry $doctrine)
    {
        $id = $request->query->get('id');

        if($id != null){
            $produit = $doctrine
                ->getRepository(TShopProduit::class)
                ->findOneBy(['prId'=>$id]);
        }
        else{
            $produit = null;
        }

        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        $souscategories = $doctrine
            ->getRepository(TShopProduitCategorie2::class)
            ->findAll();
        $maisons = $doctrine
            ->getRepository(TShopProduitMaison::class)
            ->findAll();

        return $this->render('admin/produit_add.html.twig', [
            'categories' => $categories,
            'souscategories' => $souscategories,
            'maisons' => $maisons,
            'produit' => $produit

        ]);
    }

    public function categorie_add(Request $request,ManagerRegistry $doctrine)
    {
        $id = $request->query->get('id');
        if($id != null){
            $categorie = $doctrine
                ->getRepository(TShopProduitCategorie::class)
                ->findOneBy(['caId'=>$id]);
        }
        else{
            $categorie = null;
        }

        return $this->render('admin/categorie_add.html.twig', [
            'categorie' => $categorie
        ]);
    }

    public function souscategorie_add(Request $request,ManagerRegistry $doctrine)
    {
        $id = $request->query->get('id');
        if($id != null){
            $souscategorie = $doctrine
                ->getRepository(TShopProduitCategorie2::class)
                ->findOneBy(['caId'=>$id]);
        }
        else{
            $souscategorie = null;
        }

        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        return $this->render('admin/souscategorie_add.html.twig', [
            'categories' => $categories,
            'souscategorie' => $souscategorie
        ]);
    }


}
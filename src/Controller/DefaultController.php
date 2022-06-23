<?php

namespace App\Controller;

use App\Entity\TShopCommande;
use App\Entity\TShopPays;
use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use App\Entity\TShopProduitMaison;
use App\Entity\TShopPromo;
use App\Entity\TShopUser;
use App\Entity\TShopUserAdresse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    public function admin_promo(ManagerRegistry $doctrine)
    {
        $promos = $doctrine
            ->getRepository(TShopPromo::class)
            ->findBy(['pDelete'=>0]);

        return $this->render('admin/admin_code_promo.html.twig', [
            'promos' => $promos,
        ]);
    }

    public function admin_commande(ManagerRegistry $doctrine)
    {
        $commandes = $doctrine
            ->getRepository(TShopCommande::class)
            ->findBy(['cdeEtatId'=>[2,3,4]]);

        return $this->render('admin/admin_commande.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    public function detail_commande(Request $request, ManagerRegistry $doctrine)
    {
        $commande = $doctrine
            ->getRepository(TShopCommande::class)
            ->findOneBy(['cdeId' => $request->query->get('id')]);
        $adressePaiement = $doctrine
            ->getRepository(TShopUserAdresse::class)
            ->findOneBy(['aId' => $commande->getCdeFacId()]);
        $adresseLivraison = $doctrine
            ->getRepository(TShopUserAdresse::class)
            ->findOneBy(['aId' => $commande->getCdeLivId()]);

        return $this->render('admin/admin_commande_detail.html.twig', [
            'commande' => $commande,
            'adressePaiement' => $adressePaiement,
            'adresseLivraison' => $adresseLivraison,
        ]);
    }

    public function admin_client(ManagerRegistry $doctrine)
    {
        $clients = $doctrine
            ->getRepository(TShopUser::class)
            ->findAll();

        return $this->render('admin/admin_client.html.twig', [
            'clients' => $clients,
        ]);
    }

    public function detail_client(Request $request, ManagerRegistry $doctrine)
    {
        $client = $doctrine
            ->getRepository(TShopUser::class)
            ->findOneBy(['uId' => $request->query->get('id')]);

        return $this->render('admin/admin_client_detail.html.twig', [
            'user' => $client,
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

    public function promo_add(Request $request,ManagerRegistry $doctrine)
    {
        $id = $request->query->get('id');
        if($id != null){
            $promo = $doctrine
                ->getRepository(TShopPromo::class)
                ->findOneBy(['pId'=>$id]);
        }
        else{
            $promo = null;
        }

        return $this->render('admin/promo_add.html.twig', [
            'promo' => $promo
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

    /**
     * @Route("/register", methods={"POST"})
     */
    public function inscription(Request $request,ManagerRegistry $doctrine,UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('post')) {
            $email = $request->request->get('email');
            $sameemail = $doctrine->getRepository(TShopUser::class)->findOneBy(['uEmail'=>$email]);
            if($sameemail == null){
                $user = new TShopUser();
                $user->setUActif(1);
                $user->setUDateCreation(new \DateTime());
                $user->setUEmail($request->request->get('email'));
                $user->setUPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                $doctrine->getManager()->persist($user);
                $doctrine->getManager()->flush();

                return $this->redirectToRoute('index');
            }
            else{
                $this->addFlash('error', "L'email est déjà utilisé");
                return $this->redirectToRoute('register');
            }
        }
    }
}
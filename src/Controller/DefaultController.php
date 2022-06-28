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
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        $newProduit =  $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prArchive'=>0,'prActif'=>1,'prNouveaux'=>1]);
        $popuProduit =  $doctrine
            ->getRepository(TShopProduit::class)
            ->findBy(['prArchive'=>0,'prActif'=>1,'prPopu'=>1]);
        return $this->render('front/default/index.html.twig', [
            'newProduit'=>$newProduit,
            'popuProduit'=>$popuProduit,
            'categories'=>$categories
        ]);
    }

    public function produit(Request $request,ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        $produit = $doctrine
            ->getRepository(TShopProduit::class)
            ->findOneBy(['prArchive'=>0,'prActif'=>1,'prId'=>$request->query->get('id')]);
        return $this->render('front/default/produit.html.twig', [
            'produit' => $produit,
            'categories'=>$categories
        ]);
    }

    public function register(ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        return $this->render('front/default/register.html.twig', [
            'categories'=>$categories
        ]);
    }

    public function contact(ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        return $this->render('front/default/contact.html.twig', [
            'categories'=>$categories
        ]);
    }

    public function panier(ManagerRegistry $doctrine)
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        $user = $this->getUser();
        if($user != null) {
            $idUser = $user->getUId();
        }else{
            $idUser = $this->get('session')->get('user');
        }
        $commande = $doctrine
            ->getRepository(TShopCommande::class)
            ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);
        if($commande != null){
            $panier = 0;
            foreach ($commande->getLignes() as $ligne){
                $panier = $panier + $ligne->getClQte();
            }
            $this->get('session')->set('panier',$panier);
        }
        return $this->render('front/default/panier.html.twig', [
            'categories'=>$categories,
            'commande'=>$commande,
        ]);
    }

    public function membre(ManagerRegistry $doctrine)
    {
        if($this->get('session')->get('user') != null){
            return $this->redirectToRoute('changeUserPanier');
        }
        $user = $this->getUser();
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

        $pays = $doctrine->getRepository(TShopPays::class)->findAll();

        return $this->render('front/default/membre.html.twig', [
            'user' => $user,
            'listepays' => $pays,
            'categories'=>$categories
        ]);
    }

    public function administrateur(ManagerRegistry $doctrine)
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
            $password = $request->request->get('password');
            $password2 = $request->request->get('password2');
            if($password == $password2){
                $email = $request->request->get('email');
                $sameemail = $doctrine->getRepository(TShopUser::class)->findOneBy(['uEmail'=>$email]);
                if($sameemail == null){
                    $user = new TShopUser();
                    $user->setUActif(1);
                    $user->setUDateCreation(new \DateTime());
                    $user->setUEmail($request->request->get('email'));
                    $user->setUPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                    $user->setUIdRang(2);
                    $doctrine->getManager()->persist($user);
                    $doctrine->getManager()->flush();
                    $this->addFlash('ok', "Inscription réussie");
                    return $this->redirectToRoute('connexion');
                }
                else{
                    $this->addFlash('error', "L'email est déjà utilisé");
                    return $this->redirectToRoute('register');
                }
            }else{
                $this->addFlash('error', "Les mots de passe doivent être identiques");
                return $this->redirectToRoute('register');
            }

        }
    }
}
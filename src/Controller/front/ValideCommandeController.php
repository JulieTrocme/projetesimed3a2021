<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopPays;
use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopPromo;
use App\Entity\TShopUser;
use App\Entity\TShopUserAdresse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ValideCommandeController extends AbstractController {

    public function commande(ManagerRegistry $doctrine, SessionInterface $session)
    {
        $idUser = $this->get('session')->get('user');
        if($idUser != null){
            $commande = $doctrine
                ->getRepository(TShopCommande::class)
                ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);
            if($commande != null){
                $panier = $doctrine
                    ->getRepository(TShopCommande::class)
                    ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$this->getUser()->getUId()]);
                if($panier != null){
                    foreach ($panier->getLignes() as $ligne){
                        $doctrine->getManager()->remove($ligne);
                        $doctrine->getManager()->flush();
                    }
                    $doctrine->getManager()->remove($panier);
                    $doctrine->getManager()->flush();
                }
                $commande->setCdeCliId($this->getUser()->getUId());
                $commande->setUser($this->getUser());
                $doctrine->getManager()->flush();
            }
            $user = $doctrine->getRepository(TShopUser::class)->findOneBy(['uId'=>$idUser]);
            $doctrine->getManager()->remove($user);
            $doctrine->getManager()->flush();
            $this->get('session')->set('user',null);
        }
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();

            $idUser = $this->getUser();

        $pays = $doctrine->getRepository(TShopPays::class)->findAll();

        $client = $doctrine
            ->getRepository(TShopUser::class)
            ->findOneBy(['uId'=>$idUser]);

            $commande = $doctrine
                ->getRepository(TShopCommande::class)
                ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);

            return $this->render('front/default/commande.html.twig', [
                'categories'=>$categories,
                'client'=>$client,
                'commande'=>$commande,
                'listepays' => $pays,
            ]);

    }
    /**
     * @Route("/commande/addAdresse", methods={"POST"})
     */
    public function addAdresse(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){
            $adresse = new TShopUserAdresse();
            $adresse->setANom($request->request->get('nom'));
            $adresse->setAPrenom($request->request->get('prenom'));
            $adresse->setAAdresse1($request->request->get('adresse1'));
            $adresse->setAAdresse2($request->request->get('adresse2'));
            $adresse->setACode($request->request->get('cp'));
            $adresse->setAActif(1);
            $adresse->setAIdPays($request->request->get('pays'));
            $adresse->setPays($doctrine->getManager()->find(TShopPays::class,$adresse->getAIdPays()));
            $adresse->setAIdUser($this->getUser()->getUId());
            $adresse->setUser($this->getUser());
            $adresse->setATelephone1($request->request->get('telephone1'));
            $adresse->setATelephone2($request->request->get('telephone2'));
            $adresse->setAVille($request->request->get('ville'));
            $adresse->setADateCreation(new \DateTime());
            $doctrine->getManager()->persist($adresse);
            $doctrine->getManager()->flush();

            return $this->redirectToRoute('commande');
        }
    }

    /**
     * @Route("/commande/valide", methods={"POST"})
     */
    public function validCommande(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){
            $cde_montant = 0;

            if ($request->request->get('cgv') == 1) {
                if ($request->request->get('cde_liv') != 0) {

                    if ($request->request->get('cde_fac') != 0 ) {
                        $commande = $doctrine
                            ->getRepository(TShopCommande::class)
                            ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$this->getUser()]);


                        //on modifie les stocks pour chaque produit
                        foreach ($commande->getLignes() as $ligne){


                            $produit = $doctrine->getRepository(TShopProduit::class)->findOneBy(['prId'=>$ligne->getClArtId()]);
                            $newStock = $produit->getPrStock() - $ligne->getClQte();
                            $produit->setPrStock($newStock);

                            $cde_montant = $cde_montant + ($ligne->getClQte() * $ligne->getClMtn());

                        }


                        //On met a jour la commande une fois que les tous les stocks sont mis a jour
                        $commande->setcdeEtatId(2);

                        $commande->setcdeLivId($request->request->get('cde_liv'));

                        $commande->setcdeFacId($request->request->get('cde_fac'));

                        $commande->setcdeCom($request->request->get('cde_com'));

                        $codePromo = $doctrine
                            ->getRepository(TShopPromo::class)
                            ->findOneBy(['pId'=>$commande->getCdeCodePromo()]);

                        //si il y a un code promo
                        if ($codePromo){
                            $cde_montant = $cde_montant - ($cde_montant * $codePromo->getpRemise() /100);
                            $commande->setcdeMtn($cde_montant);
                            if ($codePromo->getpLivraison()){
                                $commande->setcdeMtnFdp(0.00);
                            }elseif ($cde_montant >= 70){
                                $commande->setcdeMtnFdp(0.00);
                            } else {
                                $commande->setcdeMtnFdp(7.35);
                            }
                        } else {
                            $commande->setcdeMtn($cde_montant);
                            if ($cde_montant >= 70){
                                $commande->setcdeMtnFdp(0.00);
                            } else {
                                $commande->setcdeMtnFdp(7.35);
                            }

                        }
                        $doctrine->getManager()->flush();

                        $this->get('session')->set('panier',0);

                        $this->addFlash('ok','Merci pour votre commande');
                        return $this->redirectToRoute('membre');
                    } else {
                        $this->addFlash('error','Merci de choisir une adresse de facturation');
                        return $this->redirectToRoute('commande');
                    }

                } else {
                    $this->addFlash('error','Merci de choisir une adresse de livraison');
                    return $this->redirectToRoute('commande');
                }

            } else {
                $this->addFlash('error','Veuillez accepter les conditions général de vente');
                return $this->redirectToRoute('commande');
            }


        }
    }

}
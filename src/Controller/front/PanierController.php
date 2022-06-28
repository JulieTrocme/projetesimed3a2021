<?php


namespace App\Controller\front;


use App\Entity\TShopCommande;
use App\Entity\TShopCommandeLigne;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopPromo;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier/deleteLigne/{id}", name="deleteLigne")
     */
    public function deleteLigne(ManagerRegistry $doctrine, int $id)
    {
        $ligne = $doctrine->getManager()->find(TShopCommandeLigne::class,['clId'=>$id]);

        $doctrine->getManager()->remove($ligne);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/quantite/{id}", name="changeQuantite")
     */
    public function changeQuantite(Request $request, ManagerRegistry $doctrine, int $id)
    {
        $quantite = $request->request->get('quantite');
        $ligne = $doctrine->getManager()->find(TShopCommandeLigne::class,['clId'=>$id]);
        if($quantite == 0){
            $doctrine->getManager()->remove($ligne);
        }else{
            $ligne->setClQte($quantite);
        }

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/promo", name="promo")
     */
    public function addPromo(Request $request, ManagerRegistry $doctrine)
    {
        $total = $request->request->get('total');
        $code = $request->request->get('code');
        $promo = $doctrine->getRepository(TShopPromo::class)->findOneBy(['pLibelle'=>$code]);
        $user = $this->getUser();
        if($user != null) {
            $idUser = $user->getUId();
        }else{
            $idUser = $this->get('session')->get('user');
        }
        $commande = $doctrine
            ->getRepository(TShopCommande::class)
            ->findOneBy(['cdeEtatId'=>1,'cdeCliId'=>$idUser]);
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        if($promo != null){
            if($promo->getPActif() == 1 && $promo->getPDelete() == 0){
                if(($promo->getPDateBegin() == null || $promo->getPDateBegin() <= new DateTime()) && ($promo->getPDateEnd() == null || $promo->getPDateEnd() >= new DateTime())){
                    if($promo->getPAPartir() == null || $promo->getPAPartir() <= $total){
                        $commande->setCdeCodePromo($promo->getPId());
                        $commande->setPromo($promo);
                        $doctrine->getManager()->flush();
                        return $this->redirectToRoute('panier');
                    }else{
                        return $this->render('front/default/panier.html.twig', [
                            'categories'=>$categories,
                            'commande'=>$commande,
                            'error'=>"Un total d'au moins ".$promo->getPAPartir()." € est necessaire pour utiliser ce code.",
                        ]);
                    }
                }
            }
        }

        return $this->render('front/default/panier.html.twig', [
            'categories'=>$categories,
            'commande'=>$commande,
            'error'=>"Ce code promo n'existe pas.",
        ]);
    }
}
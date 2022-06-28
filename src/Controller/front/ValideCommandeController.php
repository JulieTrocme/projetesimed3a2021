<?php

namespace App\Controller\front;

use App\Entity\TShopCommande;
use App\Entity\TShopPays;
use App\Entity\TShopProduitCategorie;
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

}
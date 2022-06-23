<?php


namespace App\Controller\admin;


use App\Entity\TShopCommande;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/administrateur/commande/annuler", methods={"POST"})
     */
    public function annulerCommande(Request $request,ManagerRegistry $doctrine): Response
    {
        $commande = $doctrine->getManager()->find(TShopCommande::class,$request->request->get('cde_id'));
        $commande->setCdeEtatId(4);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_commande');
    }

    /**
     * @Route("/administrateur/commande/valider", methods={"POST"})
     */
    public function validerCommande(Request $request,ManagerRegistry $doctrine): Response
    {
        $commande = $doctrine->getManager()->find(TShopCommande::class,$request->request->get('cde_id'));
        $commande->setCdeEtatId(3);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_commande');
    }
}
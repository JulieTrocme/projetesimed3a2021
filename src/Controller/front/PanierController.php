<?php


namespace App\Controller\front;


use App\Entity\TShopCommandeLigne;
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
    public function changeQuantite(Request $request, ManagerRegistry $doctrine, int $id, int $quantite)
    {
        $quantite = $request->request->get('quantite');
        $ligne = $doctrine->getManager()->find(TShopCommandeLigne::class,['clId'=>$id]);
        $ligne->setClQte($quantite);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('panier');
    }
}
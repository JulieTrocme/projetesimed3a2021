<?php


namespace App\Controller\admin;


use App\Entity\TShopPromo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoController extends AbstractController
{
    /**
     * @Route("/administration/promo/addPromo", methods={"POST"})
     */
    public function addPromo(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){
            $id = $request->request->get('p_id');
            if($id == 0) {
                $promo = new TShopPromo();
            }
            else{
                $promo = $doctrine->getRepository(TShopPromo::class)->findOneBy(['pId'=>$id]);
            }
            $promo->setPActif($request->request->get('p_actif'));
            $promo->setPAPartir($request->request->get('p_a_partir'));
            $promo->setPDateBegin(new \DateTime($request->request->get('p_date_begin')));
            $promo->setPDateEnd(new \DateTime($request->request->get('p_date_end')));
            $promo->setPDesc($request->request->get('p_desc'));
            $promo->setPLibelle($request->request->get('p_libelle'));
            $promo->setPLivraison($request->request->get('p_livraison'));
            $promo->setPRemise($request->request->get('p_remise'));
            if($id == 0){
                $doctrine->getManager()->persist($promo);
            }
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('admin_promo');
        }
    }

    /**
     * @Route("/administrateur/promo/delete", methods={"POST"})
     */
    public function deletePromo(Request $request,ManagerRegistry $doctrine): Response
    {
        $produit = $doctrine->getManager()->find(TShopPromo::class,$request->request->get('p_id'));
        $produit->setPDelete(1);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_promo');
    }
}
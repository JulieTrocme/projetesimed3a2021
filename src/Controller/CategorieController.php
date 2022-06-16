<?php


namespace App\Controller;


use App\Entity\TShopProduitCategorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends AbstractController
{
    /**
     * @Route("/administration/categorie/addCategorie", methods={"POST"})
     */
    public function addCategorie(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){
            $categorie = new TShopProduitCategorie();
            $categorie->setCaTitre($request->request->get('ca_titre'));
            $categorie->setCaDesc($request->request->get('ca_desc'));
            $categorie->setCaSeoUrl($request->request->get('ca_seo_url'));
            $categorie->setCaSeoTitre($request->request->get('ca_seo_titre'));
            $categorie->setCaSeoDesc($request->request->get('ca_seo_desc'));
            $categorie->setCaDateUpdate(new \DateTime());
            $categorie->setCaOrdre(0);
            $categorie->setCaActif(1);
            $doctrine->getManager()->persist($categorie);
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('admin_categorie');
        }
    }
}
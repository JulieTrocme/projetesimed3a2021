<?php


namespace App\Controller\admin;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SousCategorieController extends AbstractController
{
    /**
     * @Route("/administration/souscategorie/addSouscategorie", methods={"POST"})
     */
    public function addSouscategorie(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){
            $id = $request->request->get('ca_id');
            if($id == 0) {
                $souscategorie = new TShopProduitCategorie2();
            }
            else{
                $souscategorie = $doctrine->getRepository(TShopProduitCategorie2::class)->findOneBy(['caId'=>$id]);
            }
            $souscategorie->setCaTitre($request->request->get('ca_titre'));
            $souscategorie->setCaDesc($request->request->get('ca_desc'));
            $souscategorie->setCaSeoUrl($request->request->get('ca_seo_url'));
            $souscategorie->setCaSeoTitre($request->request->get('ca_seo_titre'));
            $souscategorie->setCaSeoDesc($request->request->get('ca_seo_desc'));
            $souscategorie->setCaCatId($request->request->get('categorie'));
            $souscategorie->setCat($doctrine->getManager()->find(TShopProduitCategorie::class,$souscategorie->getCaCatId()));
            $souscategorie->setCaDateUpdate(new \DateTime());
            if($id == 0){
                $souscategorie->setCaOrdre(0);
                $souscategorie->setCaActif(1);
                $doctrine->getManager()->persist($souscategorie);
            }
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('admin_souscategorie');
        }
    }

    /**
     * @Route("/administration/souscategorie/delete", methods={"POST"})
     */
    public function souscategorie_delete(Request $request,ManagerRegistry $doctrine): Response
    {
        $categorie = $doctrine->getManager()->find(TShopProduitCategorie2::class,$request->request->get('ca_id'));
        $categorie->setCaActif(0);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_souscategorie');
    }
}
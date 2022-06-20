<?php


namespace App\Controller\admin;


use App\Entity\TShopProduit;
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
            $id = $request->request->get('ca_id');
            if($id == 0) {
                $categorie = new TShopProduitCategorie();
            }
            else{
                $categorie = $doctrine->getRepository(TShopProduitCategorie::class)->findOneBy(['caId'=>$id]);
            }
            $categorie->setCaTitre($request->request->get('ca_titre'));
            $categorie->setCaDesc($request->request->get('ca_desc'));
            $categorie->setCaSeoUrl($request->request->get('ca_seo_url'));
            $categorie->setCaSeoTitre($request->request->get('ca_seo_titre'));
            $categorie->setCaSeoDesc($request->request->get('ca_seo_desc'));
            $categorie->setCaDateUpdate(new \DateTime());
            if($id == 0){
                $categorie->setCaOrdre(0);
                $categorie->setCaActif(1);
                $doctrine->getManager()->persist($categorie);
            }
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('admin_categorie');
        }
    }

    /**
     * @Route("/administration/categorie/delete", methods={"POST"})
     */
    public function categorie_delete(Request $request,ManagerRegistry $doctrine): Response
    {
        //On cherche l'id de la catégorie
        $categorie = $doctrine->getManager()->find(TShopProduitCategorie::class,$request->request->get('ca_id'));


        //Pour chaque souscategorie relié à la categorie
        foreach ($categorie->getSouscats() as $souscat){

            //On supprime la souscatégorie
            $doctrine->getManager()->remove($souscat);
        }

        //On cherche tous les produits qui appartient a cette catégorie et on va les mettre a zero
        $produits = $doctrine->getRepository(TShopProduit::class)->findBy(['prIdCat1' => $categorie->getCaId()]);

        foreach ($produits as $pro){
            $pro->setPrIdCat1(0);
            $pro->setPrIdCat2(0);
        }


        //Maintenant on peut supprimer la catégorie
        $doctrine->getManager()->remove($categorie);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_categorie');
    }
}
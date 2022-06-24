<?php


namespace App\Controller\admin;


use App\Entity\TShopProduit;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopProduitCategorie2;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminProduitController extends AbstractController
{
    /**
     * @Route("/administrateur/produit/addProduit", methods={"POST"})
     */
    public function addProduit(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){

            $id = $request->request->get('pr_id');

            if($id == 0) {
                $nouveautesToday = $doctrine->getRepository(TShopProduit::class)->findBy(['prNouveaux'=>1,'prDateCreation'=>new \DateTime()]);
                $nouveautes = $doctrine->getRepository(TShopProduit::class)->findBy(['prNouveaux'=>1],['prDateCreation' => 'DESC']);
                if(count($nouveautesToday) > 3){
                    foreach ($nouveautes as $nouveaute){
                        $nouveaute->setPrNouveaux(0);
                        $doctrine->getManager()->flush();
                    }
                    foreach ($nouveautesToday as $nouveaute){
                        $nouveaute->setPrNouveaux(1);
                        $doctrine->getManager()->flush();
                    }
                }
                else{
                    foreach ($nouveautes as $nouveaute){
                        $nouveaute->setPrNouveaux(0);
                        $doctrine->getManager()->flush();
                    }
                    for ($i = 0; $i < 4; $i++) {
                        $nouveautes[$i]->setPrNouveaux(1);
                        $doctrine->getManager()->flush();
                    }
                }
                $produit = new TShopProduit();
            }
            else{
                $produit = $doctrine->getRepository(TShopProduit::class)->findOneBy(['prId'=>$id]);
            }

            $produit->setPrIdCat1($request->request->get('pr_id_cat1'));
            $produit->setCat($doctrine->getManager()->find(TShopProduitCategorie::class,$produit->getPrIdCat1()));

            $produit->setPrIdCat2($request->request->get('pr_id_cat2'));
            $produit->setCat2($doctrine->getManager()->find(TShopProduitCategorie2::class,$produit->getPrIdCat2()));

            $produit->setPrIdMaison($request->request->get('pr_id_maison'));
            $produit->setPrStock($request->request->get('pr_stock'));
            $produit->setPrTitre($request->request->get('pr_titre'));
            $produit->setPrDescShort($request->request->get('pr_desc_short'));
            $produit->setPrDesc($request->request->get('pr_desc'));
            $produit->setPrTva($request->request->get('pr_tva'));
            $produit->setPrSeoUrl($request->request->get('pr_seo_url'));
            $produit->setPrSeoTitre($request->request->get('pr_seo_titre'));
            $produit->setPrSeoDesc($request->request->get('pr_seo_desc'));
            $produit->setPrRef($request->request->get('pr_ref'));
            $produit->setPrMiseAvant($request->request->get('pr_mise_avant'));
            $produit->setPrMiseAvantPanier($request->request->get('pr_mise_avant_panier'));
            $produit->setPrParticularite($request->request->get('pr_particularite'));
            $produit->setPrActif($request->request->get('pr_actif'));
            $produit->setPrPopu($request->request->get('pr_popu'));
            $produit->setPrPrix($request->request->get('pr_prix'));
            $produit->setPrNouveaux(1);
            $produit->setPrDateCreation(new \DateTime());
            $doctrine->getManager()->persist($produit);
            $doctrine->getManager()->flush();

            return $this->redirectToRoute('admin_produit');
        }
    }

    /**
     * @Route("/administration/produit/deleteProduit", methods={"POST"})
     */
    public function delProduit(Request $request,ManagerRegistry $doctrine): Response
    {
        $produit = $doctrine->getManager()->find(TShopProduit::class,$request->request->get('pr_id'));
        $produit->setPrArchive(1);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_produit');
    }
}
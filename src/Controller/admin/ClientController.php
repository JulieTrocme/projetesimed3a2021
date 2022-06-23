<?php


namespace App\Controller\admin;


use App\Entity\TShopUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/administration/client/delete", methods={"POST"})
     */
    public function client_delete(Request $request,ManagerRegistry $doctrine): Response
    {
        $client = $doctrine->getManager()->find(TShopUser::class,$request->request->get('u_id'));


        foreach ($client->getCommandes() as $commande){
            foreach ($commande->getLignes() as $ligne){
                $doctrine->getManager()->remove($ligne);
            }
            $doctrine->getManager()->remove($commande);
        }
        foreach ($client->getAdresses() as $adresse){
            $doctrine->getManager()->remove($adresse);
        }

        $doctrine->getManager()->remove($client);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('admin_client');
    }
}
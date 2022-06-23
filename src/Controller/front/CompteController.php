<?php


namespace App\Controller\front;


use App\Entity\TShopPays;
use App\Entity\TShopUser;
use App\Entity\TShopUserAdresse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteController extends AbstractController
{
    /**
     * @Route("/membre/addAdresse", methods={"POST"})
     */
    public function addAdresse(Request $request,ManagerRegistry $doctrine){
        if($request->isMethod('post')){

            $id = $request->request->get('id');

            if($id == 0) {
                $adresse = new TShopUserAdresse();
            }
            else{
                $adresse = $doctrine->getRepository(TShopUserAdresse::class)->findOneBy(['aId'=>$id]);
            }

            $adresse->setANom($request->request->get('nom'));
            $adresse->setAPrenom($request->request->get('prenom'));
            $adresse->setAAdresse1($request->request->get('adresse1'));
            $adresse->setAAdresse2($request->request->get('adresse2'));
            $adresse->setACode($request->request->get('cp'));
            $adresse->setAActif(1);
            $adresse->setAIdPays($request->request->get('pays'));
            $adresse->setPays($doctrine->getManager()->find(TShopPays::class,$adresse->getAIdPays()));
            $adresse->setAIdUser(1);
            $adresse->setUser($doctrine->getManager()->find(TShopUser::class,$adresse->getAIdUser()));
            $adresse->setATelephone1($request->request->get('telephone1'));
            $adresse->setATelephone2($request->request->get('telephone2'));
            $adresse->setAVille($request->request->get('ville'));
            if($id == 0) $adresse->setADateCreation(new \DateTime());
            if($id != 0) $adresse->setADateModification(new \DateTime());
            $doctrine->getManager()->persist($adresse);
            $doctrine->getManager()->flush();

            return $this->redirectToRoute('membre');
        }
    }

    /**
     * @Route("/membre/adresse/delete", methods={"POST"})
     */
    public function adresse_delete(Request $request,ManagerRegistry $doctrine): Response
    {
        $adresse = $doctrine->getManager()->find(TShopUserAdresse::class,$request->request->get('id'));

        $adresse->setAActif(0);

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('membre');
    }

    /**
     * @Route("/membre/edit", methods={"POST"})
     */
    public function edit(Request $request,ManagerRegistry $doctrine,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $doctrine->getManager()->find(TShopUser::class,$request->request->get('id'));

        if($request->request->get('email') != null)$user->setUEmail($request->request->get('email'));
        if($request->request->get('password') != null)$user->setUPassword($passwordEncoder->encodePassword( $user, $request->request->get('password')));

        $doctrine->getManager()->flush();

        return $this->redirectToRoute('membre');
    }
}
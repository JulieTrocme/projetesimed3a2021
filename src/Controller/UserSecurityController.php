<?php

namespace App\Controller;

use App\Entity\TShopCommande;
use App\Entity\TShopProduitCategorie;
use App\Entity\TShopUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserSecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils): Response
    {
        $categories = $doctrine
            ->getRepository(TShopProduitCategorie::class)
            ->findAll();
        if ($this->getUser()) {
            return $this->redirectToRoute('changeUserPanier');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('front/default/login.html.twig', ['categories'=>$categories,'last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

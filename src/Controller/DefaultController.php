<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

    public function index()
    {
        return $this->render('front/default/index.html.twig', [

        ]);
    }

    public function boutique()
    {
        return $this->render('front/default/produits.html.twig', [

        ]);
    }

    public function produit()
    {
        return $this->render('front/default/produit.html.twig', [

        ]);
    }

    public function login()
    {
        return $this->render('front/default/login.html.twig', [

        ]);
    }

    public function register()
    {
        return $this->render('front/default/register.html.twig', [

        ]);
    }

    public function contact()
    {
        return $this->render('front/default/contact.html.twig', [

        ]);
    }

    public function panier()
    {
        return $this->render('front/default/panier.html.twig', [

        ]);
    }

    public function membre()
    {
        return $this->render('front/default/membre.html.twig', [

        ]);
    }
}
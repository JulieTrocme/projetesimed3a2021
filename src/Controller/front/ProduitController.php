<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function produit()
    {
        return $this->render('front/default/produit.html.twig', [

        ]);
    }


}
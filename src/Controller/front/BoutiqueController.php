<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BoutiqueController extends AbstractController
{

    public function boutique()
    {

        return $this->render('front/default/produits.html.twig', [

        ]);
    }


}
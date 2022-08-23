<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Date; //import l'Entité Date
use App\Form\CreerUneSortieType; //importation du formulaire CreeUneSortie

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }




    #[Route('/CreerSortie', name: 'app_sortie')]
    public function CreerSortie(): Response
    {
        $sortie = new Date();
        $sortieForm = $this->createForm(CreerUneSortieType::class,$sortie);
        return $this->render( 'sortie/formSortie.html.twig',["sortieForm"=> $sortieForm->createview()] );
    }


}

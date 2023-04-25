<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search/{search}', name: 'app_search')]
    public function index($search, ProductRepository $proRep): Response
    {
        $result = $proRep->searchBy($search);
        dd($result);
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    // public function searchAction(HttpFoundationRequest $request){

    //     $em = $this->getDoctrine()->getManager();
    //     $formulari = $this->createForm('AppBundle\Form\SearchType');
    //     $formulari->handleRequest($request);
    
    //     if ($formulari->isSubmitted() && $formulari->isValid()) {
    //          $data = $formulari->getData();
    
    //          // ... perform some action, such as saving the data to the database or search         
    //      }
    
    //     return $this->render('search.html.twig', ['form' => $formulari->createView()]);
    // }


}
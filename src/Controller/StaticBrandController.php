<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticBrandController extends AbstractController
{
    #[Route('/brand/{id}', name: 'app_static_brand')]
    public function index(Brand $brand, ProductRepository $productRepository, $id): Response
    {
        return $this->render('static_brand/index.html.twig', [
            'controller_name' => 'StaticBrandController',
            'brand' => $brand,
            'products' => $productRepository->findBy(["Fk_brand" => $id]),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    #[Route('/', name: 'app_static')]
    public function index(ProductRepository $productRepository): Response
    {

        return $this->render('static/index.html.twig', [
            'controller_name' => 'StaticController',
            'products' => $productRepository->findAll(),
        ]);
    }
    #[Route('/show/{id}', name: 'app_static_show')]
    public function show(Product $product, ProductRepository $productRepository): Response
    {
        $brand = $product->getFkBrand();

        $type = $product->getType();
        return $this->render('static/show.html.twig', [
            'product' => $product,
            'brand' => $brand,
            'type' => $type,
            'products' => $productRepository->findAll(),
        ]);
    }
}

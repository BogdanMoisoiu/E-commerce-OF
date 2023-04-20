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
    #[Route('/{id}', name: 'app_static_show')]
    public function show(Product $product, Brand $brand): Response
    {
        $brand = $product->getFkBrand();
        return $this->render('static/show.html.twig', [
            'controller_name' => 'StaticController',
            'product' => $product,
            'brand' => $brand,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function landing(): Response
    {

        return $this->render('static/index.html.twig', [
 
        ]);
    }
    #[Route('/catalog', name: 'app_static')]
    public function index(ProductRepository $productRepository): Response
    {

        return $this->render('static/catalog.html.twig', [
            'products' => $productRepository->findBy(['approved' => '1']),
        ]);
    }

    #[Route('/category/{type}', name: 'app_static_category', methods: ['GET'])]
    public function category(ProductRepository $productRepository, $type): Response
    {


        return $this->render('static/category.html.twig', [
            'products' => $productRepository->findBy(array("type"=>$type)),
        ]);
    }

    #[Route('/show/{id}', name: 'app_static_show')]
    public function show(Product $product, ProductRepository $productRepository, ReviewsRepository $reviewsRepository): Response
    {
        // $user = $this->getUser();
        $brand = $product->getFkBrand();
        $type = $product->getType();

        $discount = $product->getDiscount();
        $price = $product->getPrice();
        $discountPrice = $price - ($price * $discount);
        return $this->render('static/show.html.twig', [
            'product' => $product,
            'brand' => $brand,
            'type' => $type,
            'products' => $productRepository->findAll(),
            'discountPrice' => $discountPrice,
            'reviews' => $reviewsRepository->findBy(["fk_product"=>$product->getId()]),
            // 'user' => $user,
        ]);
    }
}

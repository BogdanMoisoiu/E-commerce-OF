<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserAccessBrandController extends AbstractController
{
    #[Route('/brand/{id}', name: 'app_user_access_brand')]
    public function index(Brand $brand, ProductRepository $productRepository, $id): Response
    {
        return $this->render('user_access_brand/index.html.twig', [
            'brand' => $brand,
            'products' => $productRepository->findBy(["Fk_brand" => $id]),
        ]);
    }
}
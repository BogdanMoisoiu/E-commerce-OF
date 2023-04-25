<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\Reviews;
use App\Entity\User;
use App\Form\OrderItemType;
use App\Form\UserType;
use App\Form\RegistrationFormType;
use App\Repository\OrderItemRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewsRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserAccessController extends AbstractController
{
    #[Route('/', name: 'app_user_access')]
    public function index(ProductRepository $productRepository): Response
    {
        
        return $this->render('user_access/index.html.twig', [
            'products' => $productRepository->findAll(),

        ]);
    }
    #[Route('/category/{type}', name: 'app_user_access_category', methods: ['GET'])]
    public function category(ProductRepository $productRepository, $type): Response
    {


        return $this->render('user_access/category.html.twig', [
            'products' => $productRepository->findBy(array("type"=>$type)),
        ]);
    }
    #[Route('/show/{id}', name: 'app_user_access_show')]
    public function show(Product $product, ProductRepository $productRepository): Response
    {
        $brand = $product->getFkBrand();
        $type = $product->getType();

        $discount = $product->getDiscount();
        $price = $product->getPrice();
        $discountPrice = $price - ($price * $discount);
        return $this->render('user_access/show.html.twig', [
            'product' => $product,
            'brand' => $brand,
            'type' => $type,
            'products' => $productRepository->findAll(),
            'discountPrice' => $discountPrice,
        ]);
    }

    #[Route('/edit', name: 'app_user_access_edit')]
    public function edit(UserRepository $userRepository, Request $request, FileUploader $fileUploader): Response
    {
        
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            if ($picture) {
                $pictureName = $fileUploader->upload($picture);
                $user->setPicture($pictureName);
            }

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_access/editprofile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'app_user_access_delete', methods: ['GET'])]
    public function delete(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $em = $doctrine->getManager();
        $em->remove($user);
        
        $em->flush();

        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/order_item/delete/{id}', name: 'app_user_access_delete_from_cart', methods: ['GET'])]
    public function deleteFromCart(ManagerRegistry $doctrine, OrderItemRepository $orderItemRepository, $id): Response
    {
        $cartItem = $orderItemRepository->find($id);
        $em = $doctrine->getManager();
        $em->remove($cartItem);
        $em->flush();

        return $this->redirectToRoute('app_order_item', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/addtocart/{id}', name: 'app_user_access_addtocart')]
    public function AddToCart(Request $request, Product $product, ProductRepository $productRepository, UserRepository $userRepository, OrderItemRepository $orderItemRepository): Response
    {
        $order = new OrderItem();
        $user = $this->getUser();
        $form = $this->createForm(OrderItemType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setFkProduct($product);
            $order->setFkUser($user);
            $order->setStatus("cart");
            $orderItemRepository->save($order, true);

            return $this->redirectToRoute('app_order_item', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order_item/cart.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/reviews/{id}', name: 'user_reviews_delete', methods: ['POST'])]
    public function deleteReviews(Request $request, Reviews $review, ReviewsRepository $reviewsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $reviewsRepository->remove($review, true);
        }

        return $this->redirectToRoute('app_user_access_index', [], Response::HTTP_SEE_OTHER);
    }

}
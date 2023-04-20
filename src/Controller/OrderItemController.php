<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Form\OrderItemType;
use App\Repository\CartRepository;
use App\Repository\OrderItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderItemController extends AbstractController
{
    #[Route('/order/item', name: 'app_order_item')]
    public function index(): Response
    {
        return $this->render('order_item/index.html.twig', [
            'controller_name' => 'OrderItemController',
        ]);
    }
    #[Route('/order/item/add', name: 'app_order_item_add')]
    public function addToCart(Request $request, OrderItemRepository $orderRepository, CartRepository $cartRepository): Response
    {$order = new OrderItem();
        $form = $this->createForm(OrderItemType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->save($order, true);

            return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order_item/index.html.twig', [
            'cart' => $order,
            'form' => $form,
        ]);
    }
}


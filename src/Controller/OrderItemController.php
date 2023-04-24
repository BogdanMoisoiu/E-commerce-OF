<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Form\OrderItemType;
use App\Repository\CartRepository;
use App\Repository\OrderItemRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderItemController extends AbstractController
{
    #[Route('/order/item', name: 'app_order_item')]
    public function index(ProductRepository $productRepository, OrderItemRepository $orderItemRepository): Response
    {
        
        return $this->render('order_item/index.html.twig', [
            'products' => $productRepository->findAll(),
            'product in cart' => $productRepository->()
        ]);
    }
    #[Route('/order/item/add', name: 'app_order_item_add')]
    public function addToCart(Request $request, OrderItemRepository $orderRepository): Response
    {$order = new OrderItem();
        $form = $this->createForm(OrderItemType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->save($order, true);

            return $this->redirectToRoute('app_order_item', [], Response::HTTP_SEE_OTHER); 
          
        }

        return $this->render('order_item/index.html.twig', [
            'cart' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cart_delete', methods: ['POST'])]
    public function delete(Request $request, OrderItem $orderItem, OrderItemRepository $orderItemRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderItem->getId(), $request->request->get('_token'))) {
            $orderItemRepository->remove($orderItem, true);
        }

        return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}


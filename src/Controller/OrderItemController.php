<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Form\OrderItemType;
use App\Repository\CartRepository;
use App\Repository\OrderItemRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderItemController extends AbstractController
{
    #[Route('/order/item', name: 'app_order_item')]
    public function index(ProductRepository $productRepository, OrderItemRepository $orderItemRepository): Response
    {
        
        return $this->render('order_item/index.html.twig', [
            'items' => $orderItemRepository->findBy(["fk_user"=>$this->getUser()]),
        ]);
    }
    #[Route('/order/item/add', name: 'app_order_item_add')]
    public function addToCart(Request $request, OrderItemRepository $orderRepository, MailerInterface $mailer, CartRepository $cartRepository): Response
    {$order = new OrderItem();
        $form = $this->createForm(OrderItemType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->save($order, true);
            // $sender = $form->get('email')->getData();
            // $email = new MailController();
            // $email->sendEmail($mailer, $sender);

            return $this->redirectToRoute('app_order_item', [], Response::HTTP_SEE_OTHER); 
          
        }

        return $this->render('order_item/index.html.twig', [
            'cart' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_item_delete', methods: ['POST'])]
    public function delete(ManagerRegistry $doctrine, Request $request, OrderItem $orderItem, OrderItemRepository $orderItemRepository, $cartItem): Response
    {
        $cartItem = $orderItem->getFkProduct();
        $em = $doctrine->getManager();
        $em->remove($cartItem);
        
        $em->flush();


        return $this->redirectToRoute('app_order_item_index', [], Response::HTTP_SEE_OTHER);
    }
}


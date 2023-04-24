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
    public function index(OrderItemRepository $orderItemRepository): Response
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
}


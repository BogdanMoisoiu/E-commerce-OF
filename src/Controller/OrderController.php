<?php

namespace App\Controller;

use App\Repository\OrderItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/order')]

class OrderController extends AbstractController
{
    #[Route('/check_out', name: 'app_order')]
    public function index(OrderItemRepository $orderItemRepository): Response
    {
        $user = $this->getUser();
        return $this->render('order/index.html.twig', [

            'items' => $orderItemRepository->findBy(["fk_user"=>$this->getUser()]),
            "user" => $user,
        ]);
    }
    #[Route('/check_out_confirm', name: 'app_order_confirm')]
    public function confirm(OrderItemRepository $orderItemRepository): Response
    {
        $now = new \DateTime('now');
        // need to update status in OrderItem and add to Order
        

        // $user = $this->getUser();
        return $this->render('order/index.html.twig', [

            // 'items' => $orderItemRepository->findBy(["fk_user"=>$this->getUser()]),
            // "user" => $user,
        ]);
    }
}

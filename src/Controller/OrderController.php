<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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
    #[Route('/check_out_confirm', name: 'app_order_confirm', methods: ['GET', 'POST'])]
    public function confirm(OrderItemRepository $orderItemRepository, OrderRepository $orderRepository, Request $request, MailerInterface $mailer): Response
    {
        $now = new \DateTime('now');
        $orderUser = $orderItemRepository->findBy(['fk_user'=>$this->getUser()]);
        $text = "";
        $total= 0;
        $sender = "";
        $text.= "<h2 style= color:#00008B;>Thank you for your Order</h2>";
        foreach ($orderUser as $val) {
            // dd($val->getFkProduct()->getName());
            // dd($val->getFkProduct()->getPrice());
            // dd($val->getQuantity());
            $sender = $val->getFkUser()->getEmail();
            $total = $total + ($val->getFkProduct()->getPrice() * $val->getQuantity());
            $text.= "<p style= color:#808080;> {$val->getFkProduct()->getName()}| Amount {$val->getQuantity()} pc. | Price in € {$val->getFkProduct()->getPrice()}</p>";
            $val->setStatus('order');
            $orderItemRepository->save($val, true);
            $order = new Order();
            $order->setFkOrderItem($val);
            $order->setDateTimeStamp($now);

            $orderRepository->save($order, true);
            
            

        }
        $text.= "<h5 style= color:#4682B4;>Total: € $total</h5>";
        $email = new MailController();
        $email->confirmEmail($mailer, $sender, "Order list", $text, "Conformation email and info about your bill");
        
        return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
    }
}

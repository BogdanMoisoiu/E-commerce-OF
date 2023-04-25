<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/check_out_confirm', name: 'app_order_confirm', methods: ['GET', 'POST'])]
    public function confirm(OrderItemRepository $orderItemRepository, OrderRepository $orderRepository, Request $request): Response
    {
        $now = new \DateTime('now');
           $orderUser = $orderItemRepository->findBy(['fk_user'=>$this->getUser()]);
        //    dd($orderUser);
        foreach ($orderUser as $val) {
            $val->setStatus('order');
            $orderItemRepository->save($val, true);
            $order = new Order();
            $order->setFkOrderItem($val);
            $order->setDateTimeStamp($now);

            $orderRepository->save($order, true);
            // $sender = $form->get('email')->getData();
            // $email = new MailController();
            // $email->sendEmail($mailer, $sender);

        }
            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }
}

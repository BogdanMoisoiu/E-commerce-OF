<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('sontomson1@gmail.com')
            ->to('sonnleitner.thomas@gmx.at') // $this->getUser()->getEMail()
            // ->cc('sonnleitner.thomas@gmx.at')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('
            Order confirmation!')
            ->text('Your order from OnlyFans!')
            ->html('<p>Thanks for your order. Your products will be shipped in the next few days!</p>');

        
        $mailer->send($email);
        return new Response('Order successfully submitted. You will shortly receive a confirmation email.');
        // ...
    }

    public function confirmEmail($mailer, $sender, $text = "Registration!", $html = "<p>Thanks for your registration!</p>",$subject = "Thanks for your Registration!" ): Response
    {
        $email = (new Email())
            ->from('sontomson1@gmail.com')
            ->to( $sender) // $this->getUser()->getEMail()
            ->cc('sonnleitner.thomas@gmx.at')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($text)
            ->html($html);

        $mailer->send($email);
        return new Response('You have succesfully registrated');
        // ...
    }
}
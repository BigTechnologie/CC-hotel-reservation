<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class TestMailerController extends AbstractController
{
    #[Route('/test-mail', name: 'app_test_mail')]
    public function testMail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('kdiallo@dawan.fr')
            ->subject('Test Mailtrap')
            ->text('Ceci est un test Mailtrap.');

        try {
            $mailer->send($email);

            return new Response('EMAIL SENT');
        } catch (\Throwable $e) {
            return new Response('EMAIL ERROR: '.$e->getMessage());
        }
    }
}
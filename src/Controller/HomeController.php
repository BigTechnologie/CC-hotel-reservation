<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return new Response('<h1>Accueil</h1>');
    }

    #[Route('/client', name: 'client_dashboard')]
    public function clientDashboard(): Response
    {
        return new Response('<h1>Espace client</h1>');
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function adminDashboard(): Response
    {
        return new Response('<h1>Espace admin</h1>');
    }
}
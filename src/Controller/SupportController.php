<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SupportController extends AbstractController
{
    #[Route('/support', name: 'support_home')]
    public function index(): Response
    {
        return new Response(
            '<html><body>' .
            '<h1>Centre de Support</h1>' .
            '<p>Bienvenue sur la page de support. Comment pouvons-nous vous aider ?</p>' .
            '<p><a href="/support/contact">Contactez-nous</a></p>' .
            '</body></html>'
        );
    }

    #[Route('/support/contact', name: 'support_contact')]
    public function contact(): Response
    {
        return new Response(
            '<html><body>' .
            '<h1>Contact Support</h1>' .
            '<p>Vous pouvez nous écrire à support@example.com</p>' .
            '<p><a href="/support">Retour au centre de support</a></p>' .
            '</body></html>'
        );
    }
}


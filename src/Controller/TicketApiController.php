<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TicketApiController extends AbstractController
{
    #[Route('/ticket/api', name: 'app_ticket_api')]
    public function index(): Response
    {
        return $this->render('ticket_api/index.html.twig', [
            'controller_name' => 'TicketApiController',
        ]);
    }
}

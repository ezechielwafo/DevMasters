<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TicketController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return new Response(
            '<html><body><h1>Bienvenue sur mon site de tickets !</h1>' .
            '<p><a href="/tickets">Voir la liste des tickets</a></p>' .
            '</body></html>'
        );
    }

    #[Route('/ticket/{id}', name: 'app_ticket_show')]
    public function show(int $id): Response
    {
        $ticket = [
            'id' => $id,
            'title' => 'Ticket ' . $id,
            'status' => 'open',
            'description' => 'Description du ticket ' . $id,
        ];

        return new Response(
            '<html><body>' .
            '<h1>Ticket #'.$ticket['id'].'</h1>' .
            '<p><strong>Titre:</strong> '.$ticket['title'].'</p>' .
            '<p><strong>Status:</strong> '.$ticket['status'].'</p>' .
            '<p><strong>Description:</strong> '.$ticket['description'].'</p>' .
            '<p><a href="/">Retour à l’accueil</a></p>' .
            '</body></html>'
        );
    }

    #[Route('/tickets', name: 'app_ticket_list')]
    public function list(): Response
    {
        $tickets = [
            ['id' => 1, 'title' => 'Ticket 1', 'status' => 'open'],
            ['id' => 2, 'title' => 'Ticket 2', 'status' => 'closed'],
            ['id' => 3, 'title' => 'Ticket 3', 'status' => 'open'],
        ];

        $ticketList = '<ul>';
        foreach ($tickets as $ticket) {
            $url = $this->generateUrl('app_ticket_show', ['id' => $ticket['id']]);
            $ticketList .= "<li><a href='$url'>Ticket #{$ticket['id']} - {$ticket['title']} - Status: {$ticket['status']}</a></li>";
        }
        $ticketList .= '</ul>';

        return new Response(
            '<html><body>' .
            '<h1>Liste des tickets</h1>' .
            $ticketList .
            '<p><a href="/">Retour à l’accueil</a></p>' .
            '</body></html>'
        );
    }
}


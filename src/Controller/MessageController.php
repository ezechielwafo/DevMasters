<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController
{
    #[Route('/message', name: 'app_message')]
    public function index(): Response
    {
        return new Response(
            '<html><body>
                <h1>Bienvenue dans la section des messages !</h1>
                <p><a href="/">Retour à l\'accueil</a></p>
            </body></html>'
        );
    }
}


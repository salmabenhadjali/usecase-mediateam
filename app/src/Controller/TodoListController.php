<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoListController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/', name: 'app_todo_list_all')]
    function homepage(): Response
    {
        $todoLists = $this->httpClient->request('GET', '/api/todoslists', [
            'timeout' => 10, // Timeout in seconds
        ]);

        return $this->render('list/homepage.html.twig', [
            'items' => $todoLists
        ]);
    }
}

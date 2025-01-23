<?php

declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use function Symfony\Component\String\u;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoListController extends AbstractController
{
    #[Route('/', name: 'app_todo_list_all')]
    function homepage(): Response
    {
        $todoLists = [
            ['id' => '1', 'title' => 'Liste 1'],
            ['id' => '2', 'title' => 'Liste 2'],
            ['id' => '3', 'title' => 'Liste 3'],
            ['id' => '4', 'title' => 'Liste 4'],
            ['id' => '5', 'title' => 'Liste 5'],
            ['id' => '6', 'title' => 'Liste 6'],
        ];

        return $this->render('list/homepage.html.twig', [
            'items' => $todoLists
        ]);
    }
}

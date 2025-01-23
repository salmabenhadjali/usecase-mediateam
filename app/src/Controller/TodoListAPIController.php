<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoListAPIController extends AbstractController
{
    #[Route('/api/todolists', methods: ['GET'], name: 'api_todolists_get_all')]
    public function getAll(LoggerInterface $logger): Response
    {
        $logger->info("Fetching all TodoLists");
        //TODO query to the database to get all Todo Lists

        $$todolists = [];

        return $this->json($todolists);
    }

    #[Route('/api/todolists/{id<\d+>}', methods: ['GET'], name: 'api_todolists_get')]
    public function getItemsByList(int $id, LoggerInterface $logger): Response
    {
        $logger->info("Fetching TodoList with ID: {id}", [
            'id' => $id,
        ]);

        //TODO query the database

        $items = [
            ['title' => 'item 1', 'subItems' => ['sub item 11']],
            ['title' => 'item 2', 'subItems' => ['sub item 21']],
            ['title' => 'item 3', 'subItems' => ['sub item 31', 'sub item 32', 'sub item 32']],
            ['title' => 'item 5', 'subItems' => ['sub item 51', 'sub item 52']],
            ['title' => 'item 6', 'subItems' => []]
        ];

        return $this->render('item/details.html.twig', [
            'items' => $items,
            'title' => 'List Name'
        ]);
    }

    #[Route('/api/todolists', methods: ['POST'], name: 'api_todolists_create')]
    public function create(int $id, LoggerInterface $logger): Response
    {
        //TODO query to the database to create the current Todo List

        $todolist = [];
        $logger->info("TodoList created with ID {id}", [
            'id' => $id,
        ]);

        return $this->json($todolist);
    }

    #[Route('/api/todolists/{id<\d+>}', methods: ['PUT'], name: 'api_todolists_update')]
    public function update(int $id, LoggerInterface $logger): Response
    {
        //TODO query to the database to create the current Todo List

        $todolist = [];
        $logger->info("TodoList updated with ID {id}", [
            'id' => $id,
        ]);

        return $this->json($todolist);
    }

    #[Route('/api/todolists/{id<\d+>}', methods: ['DELETE'], name: 'api_todolists_delete')]
    public function delete(int $id, LoggerInterface $logger): Response
    {
        //TODO query to the database to delete the current Todo List

        $todolist = [];
        $logger->info("TodoList deleted with ID {id}", [
            'id' => $id,
        ]);

        return $this->json($todolist);
    }
}

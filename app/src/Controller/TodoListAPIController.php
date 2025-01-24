<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\TodoList;
use Psr\Log\LoggerInterface;
use App\Repository\TodoListRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoListAPIController extends AbstractController
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/api/todolists', methods: ['GET'], name: 'api_todolists_get_all')]
    public function getAll(TodoListRepository $todoListRepository): Response
    {
        $this->logger->info("Fetching all TodoLists");
        // fetch all Todolists
        $todolists = $todoListRepository->findAll();

        return $this->json($todolists, Response::HTTP_OK, [], ['groups' => 'todo_list']);
    }

    #[Route('/api/todolists/{id<\d+>}', methods: ['GET'], name: 'api_todolists_get')]
    public function getItemsByList(int $id, TodoListRepository $todoListRepository): Response
    {
        $this->logger->info("Fetching TodoList with ID {id}", [
            'id' => $id
        ]);

        /* @var TodoList $todoList */
        $todoList = $todoListRepository->find($id);

        if (!$todoList) {
            $this->logger->error("TodoList with ID {id} not found", [
                'id' => $id
            ]);
            return $this->json(['message' => 'TodoList not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->render('item/details.html.twig', [
            'items' => $todoList->getItems(),
            'name' => $todoList->getName(),
        ]);
    }

    #[Route('/api/todolists', methods: ['POST'], name: 'api_todolists_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['name'])) {
            $this->logger->error('Invalid data for creating a TodoList');
            return $this->json(['message' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
        };

        $todolist = new TodoList();
        $todolist->setName($data['name']);
        $now = new DateTimeImmutable();
        $todolist->setCreatedAt($now);
        $todolist->setUpdatedAt($now);

        $entityManager->persist($todolist);
        $entityManager->flush();

        $this->logger->info('Todolist cretaed with ID {id}', [
            'id' => $todolist->getId(),
        ]);

        return $this->json([
            'id' => $todolist->getId(),
            'message' => 'Todolost created successfully',
        ], Response::HTTP_CREATED);
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

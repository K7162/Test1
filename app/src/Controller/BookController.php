<?php

namespace App\Controller;

use App\Form\BookType;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Book controller.
 */
class BookController extends AbstractController
{
    /**
     * Constructor.
     *
     * @param BookService $bookService Book service
     */
    public function __construct(private readonly BookService $bookService)
    {
    }

    /**
     * Edit book.
     *
     * @param int     $id      Book id
     * @param Request $request HTTP request
     */
    #[Route('/book/{id}/edit', name: 'book_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        $book = $this->bookService->findById($id);

        if (!$book) {
            throw $this->createNotFoundException('Book not found');
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookService->save($book);

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return $this->render('book/edit.html.twig', ['form' => $form]);
    }

    /**
     * Show book.
     *
     * @param int $id Book id
     */
    #[Route('/book/{id}', name: 'book_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $book = $this->bookService->findById($id);

        if (!$book) {
            throw $this->createNotFoundException('Book not found');
        }

        return $this->render('book/show.html.twig', ['book' => $book]);
    }
}

<?php

namespace App\Service;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Book service.
 */
class BookService
{
    /**
     * Constructor.
     *
     * @param EntityManagerInterface $entityManager  Entity manager
     * @param BookRepository         $bookRepository Book repository
     */
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly BookRepository $bookRepository)
    {
    }

    /**
     * Save book.
     *
     * @param Book $book Book entity
     */
    public function save(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    /**
     * Find book by id.
     *
     * @param int $id Book id
     */
    public function findById(int $id): ?Book
    {
        return $this->bookRepository->find($id);
    }
}

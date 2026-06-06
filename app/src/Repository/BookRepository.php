<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Book repository.
 *
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Manager registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Find book with all relations.
     *
     * @param int $id Book id
     */
    public function findWithRelations(int $id): ?Book
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.authors', 'a')->addSelect('a')
            ->leftJoin('b.genre', 'g')->addSelect('g')
            ->leftJoin('b.publisher', 'p')->addSelect('p')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

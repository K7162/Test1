<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Publisher;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $this->createMany(100, 'books', function ($i) {
            $book = new Book();
            $book->setTitle(preg_replace('/\./', '', $this->faker->sentence($this->faker->numberBetween(1, 5))));
            $book->setTotalPages($this->faker->numberBetween(20, 1200));
            $book->setPublishedYear($this->faker->numberBetween(1950, 2024));
            $book->setGenre($this->getRandomReference('genres', Genre::class));
            $book->setPublisher($this->getRandomReference('publishers', Publisher::class));

            $authors = $this->getRandomReferenceList(
                'authors',
                Author::class,
                $this->faker->numberBetween(1, 5)
            );
            foreach ($authors as $author) {
                $book->addAuthor($author);
            }

            return $book;
        });
    }

    public function getDependencies(): array
    {
        return [AuthorFixtures::class, GenreFixtures::class, PublisherFixtures::class];
    }
}

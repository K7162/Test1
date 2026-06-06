<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book entity.
 */
#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: 'books')]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(min: 20, max: 3600)]
    private ?int $totalPages = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(1750)]
    private ?int $publishedYear = null;

    /**
     * @var Collection<int, Author>
     */
    #[ORM\ManyToMany(targetEntity: Author::class)]
    #[ORM\JoinTable(name: 'books_authors')]
    #[Assert\Count(min: 1)]
    private Collection $authors;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Genre $genre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Publisher $publisher = null;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * Get id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get title.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title Title
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get total pages.
     */
    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    /**
     * Set total pages.
     *
     * @param int $totalPages Total pages
     */
    public function setTotalPages(int $totalPages): static
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * Get published year.
     */
    public function getPublishedYear(): ?int
    {
        return $this->publishedYear;
    }

    /**
     * Set published year.
     *
     * @param int $publishedYear Published year
     */
    public function setPublishedYear(int $publishedYear): static
    {
        $this->publishedYear = $publishedYear;

        return $this;
    }

    /**
     * Get authors.
     *
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * Add author.
     *
     * @param Author $author Author
     */
    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    /**
     * Remove author.
     *
     * @param Author $author Author
     */
    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    /**
     * Get genre.
     */
    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    /**
     * Set genre.
     *
     * @param Genre|null $genre Genre
     */
    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get publisher.
     */
    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    /**
     * Set publisher.
     *
     * @param Publisher|null $publisher Publisher
     */
    public function setPublisher(?Publisher $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre entity.
 */
#[ORM\Entity(repositoryClass: GenreRepository::class)]
#[ORM\Table(name: 'genres')]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $genre = null;

    /**
     * Get id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get genre.
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * Set genre.
     *
     * @param string $genre Genre
     */
    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}

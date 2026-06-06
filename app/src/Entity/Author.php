<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author entity.
 */
#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Table(name: 'authors')]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $firstName = null;

    #[ORM\Column(length: 128)]
    private ?string $lastName = null;

    /**
     * Get id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get first name.
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set first name.
     *
     * @param string $firstName First name
     */
    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get last name.
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set last name.
     *
     * @param string $lastName Last name
     */
    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }
}

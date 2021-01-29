<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WishRepository::class)
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Votre idée doit avoir un titre")
     * @Assert\Length(
     *     min=10,
     *     max=250,
     *     minMessage="Votre titre doit faire au moins 10 caractères",
     *     maxMessage="Votre titre ne doit pas dépasser 250 caractères"
     * )
     *
     * @ORM\Column(type="string", length=250)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="Votre idée doit avoir une description")
     * @Assert\Length(
     *     min=10,
     *     max=1500,
     *     minMessage="Votre description doit faire au moins 10 caractères",
     *     maxMessage="Votre description ne doit pas dépasser 1500 caractères"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Indiquez votre nom d'auteur svp")
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="Votre nom d'auteur doit faire au moins 3 caractères",
     *     maxMessage="Votre nom d'auteur ne doit pas dépasser 50 caractères"
     * )
     *
     * @ORM\Column(type="string", length=50)
     */
    private $author;

    /**
     *
     *
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="wishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}

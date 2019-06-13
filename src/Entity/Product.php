<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={"normalization_context"={"groups"={"collection"}}}
 *     },
 *     itemOperations={
 *          "get"={"normalization_context"={"groups"={"get", "details"}}}
 *     },
 *     attributes={"pagination_items_per_page"=25}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("collection")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Groups("collection")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("details")
     */
    private $builder;

    /**
     * @ORM\Column(type="float")
     * @Groups("details")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("details")
     */
    private $available;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("details")
     */
    private $description;

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

    public function getBuilder(): ?string
    {
        return $this->builder;
    }

    public function setBuilder(string $builder): self
    {
        $this->builder = $builder;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

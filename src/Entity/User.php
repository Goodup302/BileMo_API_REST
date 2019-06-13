<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
 *     collectionOperations={
 *          "post"= {
 *              "normalization_context"={"groups"={"create"}}
 *          }
 *      },
 *     itemOperations={"get", "delete"}
 * )
 * @UniqueEntity("username")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private $id;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @Groups({"create"})
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get", "create"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get", "create"})
     * @Assert\Email()
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->username;
    }

    public function setUserName(string $name): self
    {
        $this->username = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}

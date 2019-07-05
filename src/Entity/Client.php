<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"users"}},
 *     collectionOperations={
 *          "get"={"normalization_context"={"groups"={"users"}}}
 *     },
 *     itemOperations={
 *          "get"={"normalization_context"={"groups"={"users"}}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements UserInterface
{
    const ROLE_USER = "ROLE_USER";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users"})
     */
    private $id;

    /**
     * @var array $users
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="client")
     * @Groups({"users"})
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Assert\NotNull()
     */
    private $email;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setClient($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getClient() === $this) {
                $user->setClient(null);
            }
        }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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




    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [self::ROLE_USER];
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials() {}
}

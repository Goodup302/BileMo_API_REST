<?php
/**
 * Created by PhpStorm.
 * User: PC-PRO
 * Date: 05/07/2019
 * Time: 10:24
 */

namespace App\Doctrine;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Client;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\User;

final class UserPersister implements DataPersisterInterface
{
    private $tokenStorage;
    private $em;
    private $client;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
    }

    public function supports($data): bool
    {
        if ($data instanceof User) {
            $this->client = $this->tokenStorage->getToken()->getUser();
            return true;
        }
    }

    public function persist($user)
    {
        /** @var User $user */
        $user->setClient($this->client);
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    public function remove($user)
    {
        /** @var User $user */
        if ($user->getClient() == $this->client) {
            $this->em->remove($user);
            $this->em->flush();
        }

    }
}
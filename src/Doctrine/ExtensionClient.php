<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ExtensionClient implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $tokenStorage;
    private $authorizationChecker;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $checker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $checker;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($resourceClass == User::class || $resourceClass == Client::class) $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * {@inheritdoc}
     */
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        if ($resourceClass == User::class || $resourceClass == Client::class) $this->addWhere($queryBuilder, $resourceClass);
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param string $entity
     */
    private function addWhere(QueryBuilder $queryBuilder, string $entity)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        if ($client instanceof Client && $this->authorizationChecker->isGranted(Client::ROLE_USER)) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            if ($entity == Client::class) {
                $queryBuilder->andWhere(sprintf('%s.id = :client', $rootAlias));
            } elseif ($entity == User::class) {
                $queryBuilder->andWhere(sprintf('%s.client = :client', $rootAlias));
            }
            $queryBuilder->setParameter('client', $client->getId());
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Tests\helper;

use Doctrine\ORM\EntityManagerInterface;

/** @method getContainer() */
trait TestDatabaseWalkerTrait
{
    /**
     * @template T of object
     *
     * @param class-string<T>      $entityClassName
     * @param array<string, mixed> $criteria
     *
     * @return null|T
     */
    public function getDatabaseEntity(string $entityClassName, array $criteria): object|null
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->getContainer()->get(EntityManagerInterface::class);
        $repository = $entityManager->getRepository($entityClassName);

        return $repository->findOneBy($criteria);
    }
}

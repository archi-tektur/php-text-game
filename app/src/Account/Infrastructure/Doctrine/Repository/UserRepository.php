<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Doctrine\Repository;

use App\Account\Domain\Repository\UserStoreInterface;
use App\Account\Infrastructure\Doctrine\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements UserStoreInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function store(User $user): void
    {
        $this->save($user, true);
    }

    public function destroy(User $user): void
    {
        $this->remove($user, true);
    }

    public function findBySsoIdentifier(string $ssoIdentifier): User|null
    {
        return $this->findOneBy(['ssoId' => $ssoIdentifier]);
    }
}

<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Doctrine\Repository;

use App\Game\Domain\Repository\GameStoreInterface;
use App\Game\Infrastructure\Doctrine\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository implements GameStoreInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function save(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Game[]
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getOneById(string $id): ?Game
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function store(Game $game): void
    {
        $this->save($game, true);
    }
}

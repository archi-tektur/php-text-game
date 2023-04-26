<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

use App\Game\Infrastructure\Doctrine\Entity\Game;

interface GameStoreInterface
{
    /**
     * @return Game[]
     */
    public function getAll(): array;

    public function getOneById(string $id): ?Game;

    public function store(Game $game): void;
}

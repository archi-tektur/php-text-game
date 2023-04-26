<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

use App\Game\Infrastructure\Doctrine\Entity\Card;

interface CardStoreInterface
{
    public function getOneById(string $cardId): ?Card;
}

<?php

declare(strict_types=1);

namespace App\Game\Application\Command\AddGameCommand;

use App\Game\Domain\Repository\GameStoreInterface;
use App\Game\Infrastructure\Doctrine\Entity\Game;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class AddGameCommandHandler
{
    public function __construct(private readonly GameStoreInterface $gameStore)
    {
    }

    public function __invoke(AddGameCommand $command): void
    {
        $game = new Game($command->getUuid(), $command->getName(), $command->getDescription());

        $this->gameStore->store($game);
    }
}

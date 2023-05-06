<?php

declare(strict_types=1);

namespace App\Game\UI\Action;

use App\Game\Domain\Repository\GameStoreInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SelectGameAction extends AbstractController
{
    private GameStoreInterface $gameStore;

    public function __construct(GameStoreInterface $gameStore)
    {
        $this->gameStore = $gameStore;
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/game/{gameId}', name: 'app.game.select')]
    public function __invoke(string $gameId): Response
    {
        $game = $this->gameStore->getOneById($gameId);

        return $this->render('/pages/startGame.html.twig', ['game' => $game]);
    }
}

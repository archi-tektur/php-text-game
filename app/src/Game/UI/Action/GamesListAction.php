<?php

declare(strict_types=1);

namespace App\Game\UI\Action;

use App\Game\Domain\Repository\GameStoreInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GamesListAction extends AbstractController
{
    private GameStoreInterface $gameStore;

    public function __construct(GameStoreInterface $gameStore)
    {
        $this->gameStore = $gameStore;
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/games', name: 'app.games.list')]
    public function __invoke(): Response
    {
        $games = $this->gameStore->getAll();

        return $this->render('/pages/gameList.html.twig', ['games' => $games]);
    }
}

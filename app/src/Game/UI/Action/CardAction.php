<?php

declare(strict_types=1);

namespace App\Game\UI\Action;

use App\Game\Domain\Repository\CardStoreInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CardAction extends AbstractController
{
    private CardStoreInterface $cardStore;

    public function __construct(CardStoreInterface $cardStore)
    {
        $this->cardStore = $cardStore;
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/card/{cardId}', name: 'app.card')]
    public function __invoke(string $cardId): Response
    {
        $card = $this->cardStore->getOneById($cardId);

        return $this->render('pages/card.html.twig', ['card' => $card]);
    }
}

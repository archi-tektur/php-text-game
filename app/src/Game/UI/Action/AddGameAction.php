<?php

declare(strict_types=1);

namespace App\Game\UI\Action;

use App\Common\UI\Controller\AbstractCommandBusAwareController;
use App\Game\Application\Command\AddGameCommand\AddGameCommand;
use App\Game\UI\Form\AddGameForm\AddGameFormData;
use App\Game\UI\Form\AddGameForm\AddGameFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class AddGameAction extends AbstractCommandBusAwareController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/games/add-game', name: 'app.game.add')]
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(AddGameFormType::class, new AddGameFormData());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var AddGameFormData $formData */
            $formData = $form->getData();

            $game = new AddGameCommand(Uuid::v4(), $formData->name, $formData->description);

            $this->do($game);

            return $this->redirectToRoute('app.games.list');
        }

        return $this->renderForm('pages/addGame.html.twig', ['form' => $form]);
    }
}

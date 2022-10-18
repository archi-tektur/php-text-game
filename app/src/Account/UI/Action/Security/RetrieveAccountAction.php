<?php

declare(strict_types=1);

namespace App\Account\UI\Action\Security;

use App\Account\UI\Session\LoginSessionHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

final class RetrieveAccountAction extends AbstractController
{
    private readonly LoginSessionHandler $loginSessionHandler;

    public function __construct(LoginSessionHandler $loginSessionHandler)
    {
        $this->loginSessionHandler = $loginSessionHandler;
    }

    #[Route('/authorize', name: 'app.security.login')]
    public function __invoke(): RedirectResponse
    {
        if ($this->loginSessionHandler->isUserStoredInSession()) {
            $token = $this->loginSessionHandler->getUserToken();

            return $this->redirectToRoute('app.security.continue-with-token', ['token'=> $token]);
        }

        $url = 'https://accounts.archi-tektur.eu/authorize?service=text-game-engine.dev';

        return $this->redirect($url);
    }
}
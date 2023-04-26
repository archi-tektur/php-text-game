<?php

declare(strict_types=1);

namespace App\Account\UI\Action\Security;

use App\Account\UI\Session\LoginSessionHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

final class RetrieveAccountAction extends AbstractController
{
    private readonly LoginSessionHandlerInterface $loginSessionHandler;

    public function __construct(LoginSessionHandlerInterface $loginSessionHandler)
    {
        $this->loginSessionHandler = $loginSessionHandler;
    }

    #[Route('/authorize', name: 'app.security.login')]
    public function __invoke(): RedirectResponse
    {
        if ($this->loginSessionHandler->isUserStoredInSession()) {
            $token = $this->loginSessionHandler->getUserToken();

            return $this->redirectToRoute('app.security.continue-with-token', ['token' => $token]);
        }

        $url = 'https://accounts.atcloud.pro/authorize?service=text-game-engine.dev';

        return $this->redirect($url);
    }
}

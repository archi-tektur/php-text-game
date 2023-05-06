<?php

declare(strict_types=1);

namespace App\Account\UI\Session;

use Symfony\Component\HttpFoundation\RequestStack;

final class LoginSessionHandler implements LoginSessionHandlerInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function isUserStoredInSession(): bool
    {
        $session = $this->requestStack->getSession();

        return $session->has('sso_account_token');
    }

    public function getUserToken(): string|null
    {
        $session = $this->requestStack->getSession();

        return $session->get('sso_account_token');
    }

    public function saveUserToken(string $token): void
    {
        $session = $this->requestStack->getSession();
        $session->set('sso_account_token', $token);
    }

    public function purgeUser(): void
    {
        $session = $this->requestStack->getSession();
        $session->remove('sso_account_token');
    }
}

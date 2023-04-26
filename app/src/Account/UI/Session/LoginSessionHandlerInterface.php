<?php

declare(strict_types=1);

namespace App\Account\UI\Session;

interface LoginSessionHandlerInterface
{
    public function isUserStoredInSession(): bool;

    public function getUserToken(): string|null;

    public function saveUserToken(string $token): void;

    public function purgeUser(): void;
}

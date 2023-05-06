<?php

declare(strict_types=1);

namespace App\Account\UI\Action\Security;

use Symfony\Component\Routing\Annotation\Route;

final class LogoutAction
{
    #[Route('/logout', name: 'app.security.logout')]
    public function __invoke(): void
    {
    }
}

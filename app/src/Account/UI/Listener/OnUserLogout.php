<?php

declare(strict_types=1);

namespace App\Account\UI\Listener;

use App\Account\UI\Session\LoginSessionHandler;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\LogoutEvent;

#[AsEventListener(event: LogoutEvent::class)]
final class OnUserLogout
{
    private LoginSessionHandler $loginSessionHandler;

    public function __construct(LoginSessionHandler $loginSessionHandler)
    {
        $this->loginSessionHandler = $loginSessionHandler;
    }

    public function __invoke(): void
    {
        $this->loginSessionHandler->purgeUser();
    }
}

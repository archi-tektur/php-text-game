<?php

declare(strict_types=1);

namespace App\Account\UI\Listener;

use App\Account\UI\Session\LoginSessionHandlerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\LogoutEvent;

#[AsEventListener(event: LogoutEvent::class)]
final class OnUserLogout
{
    private LoginSessionHandlerInterface $loginSessionHandler;

    public function __construct(LoginSessionHandlerInterface $loginSessionHandler)
    {
        $this->loginSessionHandler = $loginSessionHandler;
    }

    public function __invoke(): void
    {
        $this->loginSessionHandler->purgeUser();
    }
}

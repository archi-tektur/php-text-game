<?php

declare(strict_types=1);

namespace App\Tests\unit\Account\UI\Session;

use App\Account\UI\Session\LoginSessionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @internal
 * @covers \App\Account\UI\Session\LoginSessionHandler
 */
class LoginSessionHandlerTest extends TestCase
{
    public function testUserIsInSession(): void
    {
        $session = $this->createMock(SessionInterface::class);
        $requestStack = $this->createMock(RequestStack::class);

        $requestStack
            ->expects(self::once())
            ->method('getSession')
            ->willReturn($session)
        ;

        $session
            ->expects(self::once())
            ->method('has')
            ->with('sso_account_token')
            ->willReturn(true)
        ;

        $loginSessionHandler = new LoginSessionHandler($requestStack);
        $loginSessionHandler->isUserStoredInSession();
    }

    public function testUserIsNotInSession(): void
    {
        $session = $this->createMock(SessionInterface::class);
        $requestStack = $this->createMock(RequestStack::class);

        $requestStack
            ->expects(self::once())
            ->method('getSession')
            ->willReturn($session)
        ;

        $session
            ->expects(self::once())
            ->method('has')
            ->willReturn(false)
        ;

        $loginSessionHandler = new LoginSessionHandler($requestStack);
        $loginSessionHandler->isUserStoredInSession();
    }
}

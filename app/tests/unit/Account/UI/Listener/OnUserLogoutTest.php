<?php

declare(strict_types=1);

namespace App\Tests\unit\Account\UI\Listener;

use App\Account\UI\Listener\OnUserLogout;
use App\Account\UI\Session\LoginSessionHandlerInterface;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class OnUserLogoutTest extends TestCase
{
    public function test(): void
    {
        $loginSessionHandler = $this->createMock(LoginSessionHandlerInterface::class);

        $loginSessionHandler
            ->expects(self::once())
            ->method('purgeUser')
        ;

        $onUserLogout = new OnUserLogout($loginSessionHandler);
        $onUserLogout();
    }
}

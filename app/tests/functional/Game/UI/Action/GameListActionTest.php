<?php

declare(strict_types=1);

namespace App\Tests\functional\Game\UI\Action;

use App\Account\Infrastructure\Doctrine\Entity\User;
use App\Tests\helper\TestDatabaseWalkerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 *
 * @covers \App\Game\UI\Action\GamesListAction
 */
final class GameListActionTest extends WebTestCase
{
    use TestDatabaseWalkerTrait;

    public function testGameAction(): void
    {
        $browser = self::createClient();

        /** @var User $user */
        $user = $this->getDatabaseEntity(User::class, ['name' => 'Daniel Kłoda']);

        $browser->loginUser($user);

        $crawler = $browser->request('GET', '/games');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('[data-phpunit-hook=select-game]');
        $link = $crawler->filter('[data-phpunit-hook=select-game]');

        $firstAnswerUrl = $link->eq(0)->attr('href');
        self::assertSame('http://localhost/game/02012e9c-4d71-45ac-902b-2e7a991cfe3c', $firstAnswerUrl);

        $secondAnswerUrl = $link->eq(1)->attr('href');
        self::assertSame('http://localhost/game/8656848a-069f-4c1d-8366-9bbe49a98158', $secondAnswerUrl);

        $thirdAnswerUrl = $link->eq(2)->attr('href');
        self::assertSame('http://localhost/game/b98caf20-c51a-4008-9c9f-3ea29ba608d6', $thirdAnswerUrl);

        $fourthAnswerUrl = $link->eq(3)->attr('href');
        self::assertSame('http://localhost/game/ea2e4c9f-b3ca-40e1-9e14-ff15f4a811a3', $fourthAnswerUrl);
    }
}

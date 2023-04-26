<?php

declare(strict_types=1);

namespace App\Tests\functional\Game\UI\Action;

use App\Account\Infrastructure\Doctrine\Entity\User;
use App\Tests\helper\TestDatabaseWalkerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversNothing
 */
final class CardActionTest extends WebTestCase
{
    use TestDatabaseWalkerTrait;

    public function testCardAction(): void
    {
        $browser = self::createClient();

        /** @var User $user */
        $user = $this->getDatabaseEntity(User::class, ['name' => 'Daniel Kłoda']);

        $browser->loginUser($user);

        $crawler = $browser->request('GET', '/card/404d67f5-2699-4665-9674-bc21b4b0c90f');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('[data-phpunit-hook=next-card]');
        $link = $crawler->filter('[data-phpunit-hook=next-card]');

        $firstAnswerUrl = $link->eq(0)->attr('href');
        self::assertSame('http://localhost/card/425adf3d-aa97-4e97-b55f-8244f2a4e1c7', $firstAnswerUrl);

        $secondAnswerUrl = $link->eq(1)->attr('href');
        self::assertSame('http://localhost/card/71b9f255-060e-4701-872f-7b25a1671828', $secondAnswerUrl);

        $thirdAnswerUrl = $link->eq(2)->attr('href');
        self::assertSame('http://localhost/card/dea41d13-c26e-44a2-919b-9d30fecd0a0a', $thirdAnswerUrl);

        $fourthAnswerUrl = $link->eq(3)->attr('href');
        self::assertSame('http://localhost/card/a28a34e4-ed9c-47d6-940a-632bfb1d2336', $fourthAnswerUrl);
    }
}

<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Doctrine\DataFixtures;

use App\Game\Infrastructure\Doctrine\Entity\Answer;
use App\Game\Infrastructure\Doctrine\Entity\Card;
use App\Game\Infrastructure\Doctrine\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gameName1 = 'First Game';
        $gameName2 = 'Second Game';
        $gameName3 = 'Third Game';
        $gameName4 = 'Fourth Game';
        $gameDescription = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, amet asperiores autem beatae
         consectetur culpa dolore eligendi enim esse incidunt labore laborum maxime mollitia natus numquam quam,
         similique tempora voluptates!';
        $gameId1 = Uuid::fromString('8656848a-069f-4c1d-8366-9bbe49a98158');
        $gameId2 = Uuid::fromString('b98caf20-c51a-4008-9c9f-3ea29ba608d6');
        $gameId3 = Uuid::fromString('02012e9c-4d71-45ac-902b-2e7a991cfe3c');
        $gameId4 = Uuid::fromString('ea2e4c9f-b3ca-40e1-9e14-ff15f4a811a3');

        $cardTitle1 = 'New Year';
        $cardTitle2 = 'New York';
        $cardTitle3 = 'New Jersey';
        $cardTitle4 = 'New Wakanda ';
        $cardTitle5 = 'New Poland';
        $cardText1 = 'Text do karty 1';
        $cardText2 = 'Text do karty 2';
        $cardText3 = 'Text do karty 3';
        $cardText4 = 'Text do karty 4';
        $cardText5 = 'Text do karty 5';
        $cardId1 = Uuid::fromString('404d67f5-2699-4665-9674-bc21b4b0c90f');
        $cardId2 = Uuid::fromString('71b9f255-060e-4701-872f-7b25a1671828');
        $cardId3 = Uuid::fromString('a28a34e4-ed9c-47d6-940a-632bfb1d2336');
        $cardId4 = Uuid::fromString('425adf3d-aa97-4e97-b55f-8244f2a4e1c7');
        $cardId5 = Uuid::fromString('dea41d13-c26e-44a2-919b-9d30fecd0a0a');

        $answerText1 = 'Text do odpowiedzi 1';
        $answerText2 = 'Text do odpowiedzi 2';
        $answerText3 = 'Text do odpowiedzi 3';
        $answerText4 = 'Text do odpowiedzi 4';
        $answerText5 = 'Text do odpowiedzi 5';
        $answerText6 = 'Text do odpowiedzi 6';
        $answerText7 = 'Text do odpowiedzi 7';
        $answerText8 = 'Text do odpowiedzi 8';
        $answerText9 = 'Text do odpowiedzi 9';
        $answerText10 = 'Text do odpowiedzi 10';
        $answerText11 = 'Text do odpowiedzi 11';
        $answerText12 = 'Text do odpowiedzi 12';
        $answerText13 = 'Text do odpowiedzi 13';
        $answerText14 = 'Text do odpowiedzi 14';
        $answerText15 = 'Text do odpowiedzi 15';
        $answerText16 = 'Text do odpowiedzi 16';

        $game1 = new Game($gameId1, $gameName1, $gameDescription);
        $game2 = new Game($gameId2, $gameName2, $gameDescription);
        $game3 = new Game($gameId3, $gameName3, $gameDescription);
        $game4 = new Game($gameId4, $gameName4, $gameDescription);

        $answer1 = new Answer($answerText1);
        $answer2 = new Answer($answerText2);
        $answer3 = new Answer($answerText3);
        $answer4 = new Answer($answerText4);
        $answer5 = new Answer($answerText5);
        $answer6 = new Answer($answerText6);
        $answer7 = new Answer($answerText7);
        $answer8 = new Answer($answerText8);
        $answer9 = new Answer($answerText9);
        $answer10 = new Answer($answerText10);
        $answer11 = new Answer($answerText11);
        $answer12 = new Answer($answerText12);
        $answer13 = new Answer($answerText13);
        $answer14 = new Answer($answerText14);
        $answer15 = new Answer($answerText15);
        $answer16 = new Answer($answerText16);

        $card1 = new Card($cardId1, $cardTitle1, $cardText1, $game1);
        $card1->addAnswer($answer1);
        $card1->addAnswer($answer2);
        $card1->addAnswer($answer3);
        $card1->addAnswer($answer4);
        $card1->setIsFirstCard(true);

        $card2 = new Card($cardId2, $cardTitle2, $cardText2, $game1);
        $card2->addAnswer($answer5);
        $card2->addAnswer($answer6);
        $card2->addAnswer($answer7);
        $card2->addAnswer($answer8);
        $card2->addSourceAnswer($answer1);

        $card3 = new Card($cardId3, $cardTitle3, $cardText3, $game1);
        $card3->addAnswer($answer9);
        $card3->addAnswer($answer10);
        $card3->addAnswer($answer11);
        $card3->addAnswer($answer12);
        $card3->addSourceAnswer($answer2);

        $card4 = new Card($cardId4, $cardTitle4, $cardText4, $game1);
        $card4->addAnswer($answer13);
        $card4->addAnswer($answer14);
        $card4->addAnswer($answer15);
        $card4->addAnswer($answer16);
        $card4->addSourceAnswer($answer3);

        $card5 = new Card($cardId5, $cardTitle5, $cardText5, $game1);
        $card5->addSourceAnswer($answer4);

        $manager->persist($game1);
        $manager->persist($game2);
        $manager->persist($game3);
        $manager->persist($game4);
        $manager->persist($answer1);
        $manager->persist($answer2);
        $manager->persist($answer3);
        $manager->persist($answer4);
        $manager->persist($answer5);
        $manager->persist($answer6);
        $manager->persist($answer7);
        $manager->persist($answer8);
        $manager->persist($answer9);
        $manager->persist($answer10);
        $manager->persist($answer11);
        $manager->persist($answer12);
        $manager->persist($answer13);
        $manager->persist($answer14);
        $manager->persist($answer15);
        $manager->persist($answer16);
        $manager->persist($card1);
        $manager->persist($card2);
        $manager->persist($card3);
        $manager->persist($card4);
        $manager->persist($card5);

        $manager->flush();
    }
}

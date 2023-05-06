<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Doctrine\Entity;

use App\Game\Infrastructure\Doctrine\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(type: 'text')]
    private string $text;

    #[ORM\ManyToOne(targetEntity: Card::class, inversedBy: 'answers')]
    #[JoinColumn(name: 'source_card_id', referencedColumnName: 'id', nullable: true)]
    private ?Card $sourceCard;

    #[ORM\ManyToOne(targetEntity: Card::class, inversedBy: 'sourceAnswers')]
    #[JoinColumn(name: 'target_card_id', referencedColumnName: 'id', nullable: true)]
    private ?Card $targetCard;

    public function __construct(string $text)
    {
        $this->id = Uuid::v4();
        $this->text = $text;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSourceCard(): ?Card
    {
        return $this->sourceCard;
    }

    public function setSourceCard(Card $sourceCard): void
    {
        $this->sourceCard = $sourceCard;
    }

    public function getTargetCard(): ?Card
    {
        return $this->targetCard;
    }

    public function setTargetCard(Card $targetCard): void
    {
        $this->targetCard = $targetCard;
    }
}

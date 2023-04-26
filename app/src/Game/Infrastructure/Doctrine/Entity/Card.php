<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Doctrine\Entity;

use App\Game\Infrastructure\Doctrine\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $text;

    #[ORM\Column(type: 'boolean')]
    private bool $isFirstCard;

    /**
     * @var Collection<int, Answer>
     */
    #[ORM\OneToMany(mappedBy: 'sourceCard', targetEntity: Answer::class)]
    private Collection $answers;

    /**
     * @var Collection<int, Answer>
     */
    #[ORM\OneToMany(mappedBy: 'targetCard', targetEntity: Answer::class)]
    private Collection $sourceAnswers;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'cards')]
    #[JoinColumn(name: 'game_id', referencedColumnName: 'id', nullable: true)]
    private Game $game;

    public function __construct(Uuid $id, string $title, string $text, Game $game)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->answers = new ArrayCollection();
        $this->sourceAnswers = new ArrayCollection();
        $this->game = $game;
        $this->isFirstCard = false;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isFirstCard(): bool
    {
        return $this->isFirstCard;
    }

    public function setIsFirstCard(bool $isFirstCard): void
    {
        $this->isFirstCard = $isFirstCard;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setSourceCard($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getSourceAnswers(): Collection
    {
        return $this->sourceAnswers;
    }

    public function addSourceAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setTargetCard($this);
        }

        return $this;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): void
    {
        $this->game = $game;
    }
}

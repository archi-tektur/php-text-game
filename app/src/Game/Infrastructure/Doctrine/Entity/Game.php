<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Doctrine\Entity;

use App\Game\Infrastructure\Doctrine\Repository\GameRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public Uuid $id;

    #[ORM\Column(length: 255)]
    public string $name;

    #[ORM\Column(type: 'text')]
    public string $description;

    /**
     * @var Collection<int, Card>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Card::class)]
    public Collection $cards;

    public function __construct(Uuid $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Collection<int, Card>
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $answer): self
    {
        if (!$this->cards->contains($answer)) {
            $this->cards->add($answer);
            $answer->setGame($this);
        }

        return $this;
    }
}

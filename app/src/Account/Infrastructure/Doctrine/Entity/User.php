<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Doctrine\Entity;

use App\Account\Infrastructure\Doctrine\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 180, unique: true)]
    private string $ssoId;

    #[ORM\Column(length: 64)]
    private string $name;

    #[ORM\Column]
    private array $roles = [];

    public function __construct(string $ssoId, string $name)
    {
        $this->id = Uuid::v4();
        $this->ssoId = $ssoId;
        $this->name = $name;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getSsoId(): string
    {
        return $this->ssoId;
    }

    public function setSsoId(string $ssoId): self
    {
        $this->ssoId = $ssoId;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->ssoId;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}

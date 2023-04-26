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

    #[ORM\Column(length: 180)]
    private string $ssoIdType;

    #[ORM\Column(length: 64)]
    private string $name;

    /** @var string[] */
    #[ORM\Column]
    private array $roles = [];

    public function __construct(string $ssoId, string $ssoIdType, string $name)
    {
        $this->id = Uuid::v4();
        $this->ssoId = $ssoId;
        $this->ssoIdType = $ssoIdType;
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

    public function getSsoIdType(): string
    {
        return $this->ssoIdType;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->ssoId;
    }

    /** @return string[] */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /** @param string[] $roles */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function eraseCredentials(): void
    {
    }
}

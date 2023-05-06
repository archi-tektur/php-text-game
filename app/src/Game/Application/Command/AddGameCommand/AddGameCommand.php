<?php

declare(strict_types=1);

namespace App\Game\Application\Command\AddGameCommand;

use Symfony\Component\Uid\Uuid;

class AddGameCommand
{
    public function __construct(
        private readonly Uuid $uuid,
        private readonly string $name,
        private readonly string $description
    ) {
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}

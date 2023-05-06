<?php

declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Account\Infrastructure\Doctrine\Entity\User;

interface UserStoreInterface
{
    public function store(User $user): void;

    public function destroy(User $user): void;

    public function findBySsoIdentifier(string $ssoIdentifier): User|null;
}

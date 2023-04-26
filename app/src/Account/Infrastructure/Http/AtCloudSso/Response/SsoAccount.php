<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Http\AtCloudSso\Response;

final class SsoAccount
{
    public readonly string $name;
    public readonly string $identifierValue;
    public readonly string $identifierType;

    public function __construct(string $name, string $identifierType, string $identifierValue)
    {
        $this->name = $name;
        $this->identifierType = $identifierType;
        $this->identifierValue = $identifierValue;
    }

    /**
     * @phpstan-ignore-next-line
     */
    public static function fromApiStructure(array $data): self
    {
        return new self($data['name'], $data['identifier']['type'], $data['identifier']['value']);
    }
}

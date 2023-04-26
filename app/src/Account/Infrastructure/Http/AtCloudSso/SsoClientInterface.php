<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Http\AtCloudSso;

use App\Account\Infrastructure\Http\AtCloudSso\Response\SsoAccount;

interface SsoClientInterface
{
    public function getUser(string $token): SsoAccount;
}

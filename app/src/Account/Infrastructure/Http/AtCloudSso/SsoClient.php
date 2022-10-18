<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Http\AtCloudSso;

use App\Account\Infrastructure\Http\AtCloudSso\Response\SsoAccount;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class SsoClient
{
    private readonly HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getUser(string $token): SsoAccount
    {
        $response = $this->httpClient->request('GET', 'https://accounts.archi-tektur.eu/api/security/me', [
            'headers' => [
                'X-Sso-External-Service-Id' => 'dc283dfc-007e-4563-a346-f27232d08780',
                'Authorization' => "Bearer {$token}"
                ]
        ]);

        $content = json_decode($response->getContent(), true);

        return SsoAccount::fromApiStructure($content);

    }

}
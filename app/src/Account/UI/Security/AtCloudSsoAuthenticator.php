<?php

declare(strict_types=1);

namespace App\Account\UI\Security;

use App\Account\Infrastructure\Doctrine\Entity\User;
use App\Account\Infrastructure\Doctrine\Repository\UserRepository;
use App\Account\Infrastructure\Http\AtCloudSso\SsoClient;
use App\Account\UI\Session\LoginSessionHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class AtCloudSsoAuthenticator extends AbstractAuthenticator
{
    private readonly RouterInterface $router;
    private readonly SsoClient $client;
    private UserRepository $userRepository;
    private LoginSessionHandler $loginSessionHandler;

    public function __construct(
        RouterInterface     $router,
        SsoClient           $client,
        UserRepository      $userRepository,
        LoginSessionHandler $loginSessionHandler
    )
    {
        $this->router = $router;
        $this->client = $client;
        $this->userRepository = $userRepository;
        $this->loginSessionHandler = $loginSessionHandler;
    }

    public function supports(Request $request): bool
    {
        $requestHasTokenParam = $request->query->has('token');

        $requestHasCorrectUrl = str_starts_with(
            $this->router->generate('app.security.continue-with-token'),
            '/continue-with-token'
        );

        return $requestHasCorrectUrl && $requestHasTokenParam;
    }

    public function authenticate(Request $request): Passport
    {
        $token = $request->query->get('token');
        $account = $this->client->getUser($token);

        $user = $this->userRepository->findOneBy(['ssoId' => $account->identifierValue]);

        if ($user === null) {
            $entity = new User($account->identifierValue, $account->name);
            $this->userRepository->save($entity, true);
        }

        $this->loginSessionHandler->saveUserToken($token);

        return new SelfValidatingPassport(new UserBadge($account->identifierValue));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $url = $this->router->generate('app.account.me');

        return new RedirectResponse($url);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}
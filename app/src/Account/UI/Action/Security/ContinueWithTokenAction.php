<?php

declare(strict_types=1);

namespace App\Account\UI\Action\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ContinueWithTokenAction extends AbstractController
{
    #[Route('/continue-with-token', name: 'app.security.continue-with-token')]
    public function __invoke(): Response
    {
        return new Response();
    }
}

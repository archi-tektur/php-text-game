<?php

declare(strict_types=1);

namespace App\Account\UI\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MyAccountAction extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/account/me', name: 'app.account.me')]
    public function __invoke(): Response
    {
        return $this->render('pages/my-account.html.twig');
    }
}

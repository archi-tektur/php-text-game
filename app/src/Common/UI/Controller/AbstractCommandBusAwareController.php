<?php

namespace App\Common\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class AbstractCommandBusAwareController extends AbstractController
{
    private MessageBusInterface $messageBus;

    #[Required]
    public function setMessageBus(MessageBusInterface $messageBus): static
    {
        $enriched = clone $this;
        $enriched->messageBus = $messageBus;

        return $enriched;
    }

    public function do(object $command): void
    {
        $this->messageBus->dispatch($command);
    }
}

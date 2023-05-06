<?php

declare(strict_types=1);

namespace App\Game\UI\Form\AddGameForm;

use Symfony\Component\Validator\Constraints as Assert;

class AddGameFormData
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    public string $description;
}

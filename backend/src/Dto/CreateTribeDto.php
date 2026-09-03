<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTribeDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 200)]
    public string $name;
}

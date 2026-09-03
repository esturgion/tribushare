<?php

namespace App\Mapper;

use App\Dto\CreateTribeDto;
use App\Entity\Tribe;

class TribeMapper
{
    public function fromCreateDto(CreateTribeDto $dto): Tribe
    {
        $tribe = new Tribe();

        $tribe->setName($dto->name);

        return $tribe;
    }
}

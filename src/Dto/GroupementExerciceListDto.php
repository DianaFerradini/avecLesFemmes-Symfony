<?php

namespace App\Dto;

use App\Entity\Groupement;
use App\Dto\PageDto;

final readonly class GroupementExerciceListDto
{
    // TODO : CONVERTI ENTITY gROUPEMENT EXERCICE EN DTO
    public function __construct(
        public int $id,
        public string $nom,
        public string $tel,
        public ?string $adresse,
        public PageDto $page,
        public int $nbrExercices = 0
    ) {
    }

    public static function fromEntity(Groupement $groupementEntity, PageDto $page, int $nbrExercices): self
    {
        return new self(
            $groupementEntity->getId(),
            $groupementEntity->getNom(),
            $groupementEntity->getTel(),
            $groupementEntity->getAdresse(),
            $page,
            $nbrExercices
        );
    }
}
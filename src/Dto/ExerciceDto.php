<?php

namespace App\Dto;

use App\Entity\Exercice;
use App\Service\DateService;

final readonly class ExerciceDto
{
    public function __construct(
        public int $id,
        public string $dateDebut,
        public string $dateFin,
        public string $retributionAt,
        public string $limitePretsAt,
        public int $nbrJoursRestant,
        public string $statut,
    ) {
    }

    public static function fromEntity(Exercice $exerciceEntity): self
    {
        return new self(
            $exerciceEntity->getId(),
            DateService::formatDate($exerciceEntity->getDebutAt()),
            DateService::formatDate($exerciceEntity->getFinAt()),
            DateService::formatDate($exerciceEntity->getRetributionAt()),
            DateService::formatDate($exerciceEntity->getLimitePretsAt()),
            DateService::calculateNbrJoursRestant($exerciceEntity->getLimitePretsAt()),
            $exerciceEntity->getStatut()->label(),
        );
    }
}
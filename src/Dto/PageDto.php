<?php

namespace App\Dto;

final class PageDto
{
    public int $nbrPages;
    public function __construct(
        public readonly int $pageEnCours,
        public readonly int $totalElements,
        public readonly int $limit,
        public array $elements,
    ) {
        $this->nbrPages = (int) ceil($totalElements / $limit);
    }

    public function precedent() : bool
    {
        return $this->pageEnCours > 1;
    }

    public function suivant() : bool
    {
        return $this->pageEnCours < $this->nbrPages;
    }
}
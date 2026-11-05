<?php

namespace App\Service;

use App\Dto\PageDto;
use Doctrine\ORM\QueryBuilder;
use \Doctrine\ORM\Tools\Pagination\Paginator;

class PaginationService
{
    public const DEFAULT_LIMIT = 5;
    public const MAX_LIMIT = 100;

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function paginate(QueryBuilder $qb, int $page = 1, int $limit = self::DEFAULT_LIMIT): PageDto {
        $query = $qb->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ;
        $paginator = new Paginator($query, false);
        $totalItems = count($paginator);
        return new PageDto($page, $totalItems, $limit, iterator_to_array($paginator));
    }
}
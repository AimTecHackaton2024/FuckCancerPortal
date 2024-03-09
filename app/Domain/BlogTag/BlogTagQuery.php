<?php

namespace App\Domain\BlogTag;

use App\Model\Database\Query\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class BlogTagQuery extends AbstractQuery
{
    public static function getAll(): self
    {
        $self = new self();
        $self->ons[] = function (QueryBuilder $qb): QueryBuilder
        {
            return $qb;
        };

        return $self;
    }

    public function setup(): void
    {
        $this->ons[] = function(QueryBuilder $qb): QueryBuilder
        {
            $qb->select('bt')
                ->from(BlogTag::class, 'bt');

            return $qb;
        };
    }
}

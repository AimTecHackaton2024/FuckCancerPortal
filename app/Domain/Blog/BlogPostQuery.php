<?php

namespace App\Domain\Blog;

use App\Model\Database\Query\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class BlogPostQuery extends AbstractQuery
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
            $qb->select('bp')
                ->from(BlogPost::class, 'bp');

            return $qb;
        };
    }
}

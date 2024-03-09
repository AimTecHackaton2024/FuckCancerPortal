<?php

namespace App\Domain\Organization;

use App\Model\Database\Query\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class OrganizationQuery extends AbstractQuery
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
            $qb->select('o')
                ->from(Organization::class, 'o');

            return $qb;
        };
    }
}

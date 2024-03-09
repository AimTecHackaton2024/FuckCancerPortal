<?php

namespace App\Domain\UserOrganization;

use App\Domain\UserOrganization\UserOrganization;
use App\Model\Database\Query\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class UserOrganizationQuery extends AbstractQuery
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
            $qb->select('us')
                ->from(UserOrganization::class, 'us');

            return $qb;
        };
    }
}

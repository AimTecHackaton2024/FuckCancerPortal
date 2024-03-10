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

    public static function getAllPersonalised(int $userId): self
    {
        $self = new self();
        $self->ons[] = function (QueryBuilder $qb) use ($userId) : QueryBuilder
        {
            return $qb->where('bp.authorId=:user')->setParameter('user', $userId);
        };

        return $self;
    }

    public static function getAllByApprover(?int $approverId): self
    {
        $self = new self();
        $self->ons[] = function (QueryBuilder $qb) use ($approverId) : QueryBuilder
        {
            if($approverId)
            {
                return $qb->where('bp.approvingId=:user')->setParameter('user', $approverId)
                    ->andWhere('bp.status=:status')->setParameter('status', BlogPost::STATUS_ASSIGNED);
            }
            else
            {
                return $qb->where('bp.approvingId IS NULL')
                    ->andWhere('bp.status=:status')->setParameter('status', BlogPost::STATUS_NEW);
            }
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

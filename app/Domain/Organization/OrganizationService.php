<?php

namespace App\Domain\Organization;

use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;

class OrganizationService
{
    private EntityManagerDecorator $em;
    private QueryBuilderManager $queryBuilderManager;

    public function __construct(
        EntityManagerDecorator $em,
        QueryBuilderManager $queryBuilderManager,
    )
    {
        $this->em = $em;
        $this->queryBuilderManager = $queryBuilderManager;
    }

    public function getById(string|int $id): Organization
    {
        if(is_string($id))
        {
            $id = intval($id);
        }
        
        return $this->em->getOrganizationRepository()->get($id);
    }

    public function findById(int $id): ?BlogPost
    {
        return $this->em->getOrganizationRepository()->find($id);
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(OrganizationQuery::getAll());
    }
}

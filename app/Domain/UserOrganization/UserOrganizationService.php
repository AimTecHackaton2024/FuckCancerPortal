<?php

namespace App\Domain\UserOrganization;

use App\Domain\UserOrganization\UserOrganization;
use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;

class UserOrganizationService
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

    public function getById(string|int $id): UserOrganization
    {
        if(is_string($id))
        {
            $id = intval($id);
        }
        
        return $this->em->getUserOrganizationRepository()->get($id);
    }

    public function findById(int $id): ?UserOrganization
    {
        return $this->em->getUserOrganizationRepository()->find($id);
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(UserOrganizationQuery::getAll());
    }
}

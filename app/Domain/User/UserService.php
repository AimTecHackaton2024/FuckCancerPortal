<?php

namespace App\Domain\User;

use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;

class UserService
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

    public function getById(int $id): User
    {
        return $this->em->getUserRepository()->get($id);
    }

    public function findById(int $id): ?User
    {
        return $this->em->getUserRepository()->find($id);
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(UserQuery::getAll());
    }
}

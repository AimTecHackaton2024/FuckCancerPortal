<?php

namespace App\Domain\Blog;

use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;

class BlogPostService
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

    public function getById(string|int $id): BlogPost
    {
        if(is_string($id))
        {
            $id = intval($id);
        }
        
        return $this->em->getBlogPostRepository()->get($id);
    }

    public function findById(int $id): ?BlogPost
    {
        return $this->em->getBlogPostRepository()->find($id);
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(BlogPostQuery::getAll());
    }
}

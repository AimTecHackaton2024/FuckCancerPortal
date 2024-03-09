<?php

namespace App\Domain\BlogTag;

use App\Domain\BlogTag\BlogTag;
use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;

class BlogTagService
{
    private EntityManagerDecorator $em;
    private QueryBuilderManager $queryBuilderManager;

    public function __construct(
        EntityManagerDecorator $em,
        QueryBuilderManager    $queryBuilderManager,
    )
    {
        $this->em = $em;
        $this->queryBuilderManager = $queryBuilderManager;
    }

    public function getById(string|int $id): BlogTag
    {
        if (is_string($id)) {
            $id = intval($id);
        }

        return $this->em->getBlogTagRepository()->get($id);
    }

    public function findById(int $id): ?BlogTag
    {
        return $this->em->getBlogTagRepository()->find($id);
    }

    public function saveTag(string $title): void
    {
        $tag = new BlogTag();
        $tag->setTitle($title);
        $this->em->persist($tag);
        $this->em->flush($tag);

    }

    public function updateTag(BlogTag $blogTag, string $title)
    {
        $blogTag->setTitle($title);
        $this->em->flush($blogTag);
    }

    public function removeTag(int $id)
    {
        $tag = $this->em->getBlogTagRepository()->get($id);
        $this->em->remove($tag);
        $this->em->flush();
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(BlogTagQuery::getAll());
    }
}

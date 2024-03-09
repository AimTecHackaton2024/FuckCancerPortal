<?php

namespace App\Domain\BlogPostTag;

use App\Domain\Blog\BlogPost;
use App\Model\Database\Repository\AbstractRepository;

/**
 * @method BlogPostTag|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method BlogPostTag|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method BlogPostTag[] findAll()
 * @method BlogPostTag[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<BlogPostTag>
 */
class BlogPostTagRepository extends AbstractRepository
{
}

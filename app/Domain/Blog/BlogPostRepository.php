<?php

namespace App\Domain\Blog;

use App\Model\Database\Repository\AbstractRepository;
use App\Model\Exception\Logic\EntityNotFoundException;


/**
 * @method BlogPost|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method BlogPost|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method BlogPost[] findAll()
 * @method BlogPost[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<BlogPost>
 */
class BlogPostRepository extends AbstractRepository
{
    public function get(int $id): BlogPost
    {
        $post = $this->find($id);

        if($post === null)
        {
            throw new EntityNotFoundException();
        }

        return $post;
    }

}

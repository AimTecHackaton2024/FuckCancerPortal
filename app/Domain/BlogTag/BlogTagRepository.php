<?php

namespace App\Domain\BlogTag;

use App\Model\Database\Repository\AbstractRepository;
use App\Model\Exception\Logic\EntityNotFoundException;


/**
 * @method BlogTag|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method BlogTag|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method BlogTag[] findAll()
 * @method BlogTag[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<BlogTag>
 */
class BlogTagRepository extends AbstractRepository
{
    public function get(int $id): BlogTag
    {
        $post = $this->find($id);

        if($post === null)
        {
            throw new EntityNotFoundException();
        }

        return $post;
    }

}

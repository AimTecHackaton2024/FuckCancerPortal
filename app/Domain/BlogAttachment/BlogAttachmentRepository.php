<?php

namespace App\Domain\BlogAttachment;

use App\Domain\Blog\BlogPost;
use App\Model\Database\Repository\AbstractRepository;

/**
 * @method BlogAttachment|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method BlogAttachment|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method BlogAttachment[] findAll()
 * @method BlogAttachment[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<BlogAttachment>
 */
class BlogAttachmentRepository extends AbstractRepository
{

}

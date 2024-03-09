<?php

namespace App\Domain\Organization;

use App\Model\Database\Repository\AbstractRepository;
use App\Model\Exception\Logic\EntityNotFoundException;


/**
 * @method Organization|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method Organization|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method Organization[] findAll()
 * @method Organization[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<Organization>
 */
class OrganizationRepository extends AbstractRepository
{
    public function get(int $id): Organization
    {
        $organization = $this->find($id);

        if($organization === null)
        {
            throw new EntityNotFoundException();
        }

        return $organization;
    }

}

<?php

namespace App\Domain\UserOrganization;

use App\Domain\UserOrganization\UserOrganization;
use App\Model\Database\Repository\AbstractRepository;
use App\Model\Exception\Logic\EntityNotFoundException;


/**
 * @method UserOrganization|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method UserOrganization|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method UserOrganization[] findAll()
 * @method UserOrganization[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<UserOrganization>
 */
class UserOrganizationRepository extends AbstractRepository
{
    public function get(int $id): UserOrganization
    {
        $organization = $this->find($id);

        if($organization === null)
        {
            throw new EntityNotFoundException();
        }

        return $organization;
    }

}

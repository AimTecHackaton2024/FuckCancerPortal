<?php declare(strict_types = 1);

namespace App\Domain\User;

use App\Model\Database\Repository\AbstractRepository;
use App\Model\Exception\Logic\EntityNotFoundException;

/**
 * @method User|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method User|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method User[] findAll()
 * @method User[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<User>
 */
class UserRepository extends AbstractRepository
{
    public function get(int $id): User
    {
        $user = $this->find($id);

        if($user === null)
        {
            throw new EntityNotFoundException();
        }

        return $user;
    }

	public function findOneByEmail(string $email): ?User
	{
		return $this->findOneBy(['email' => $email]);
	}

}

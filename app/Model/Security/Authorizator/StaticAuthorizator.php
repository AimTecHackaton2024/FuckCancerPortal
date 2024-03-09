<?php declare(strict_types = 1);

namespace App\Model\Security\Authorizator;

use App\Domain\User\User;
use Nette\Security\Permission;

final class StaticAuthorizator extends Permission
{

	/**
	 * Create ACL
	 */
	public function __construct()
	{
		$this->addRoles();
		$this->addResources();
		$this->addPermissions();
	}

	/**
	 * Setup roles
	 */
	protected function addRoles(): void
	{
		$this->addRole(User::ROLE_ADMIN);
	}

	/**
	 * Setup resources
	 */
	protected function addResources(): void
	{
		$this->addResource('Admin:Home');
        $this->addResource('Admin:User:list');
        $this->addResource('Admin:User:edit');
        $this->addResource('Admin:BlogPost');
        $this->addResource('Admin:BlogPost:list');
        $this->addResource('Admin:BlogPost:add');
        $this->addResource('Admin:BlogPost:edit');
        $this->addResource('Admin:Settings');
        $this->addResource('Admin:Organization:list');
        $this->addResource('Admin:BlogTag:list');
        $this->addResource('Admin:BlogTag:add');
        $this->addResource('Admin:BlogTag:edit');
	}

	/**
	 * Setup ACL
	 */
	protected function addPermissions(): void
	{
		$this->allow(User::ROLE_ADMIN, [
			'Admin:Home',
		]);

        $this->allow();
	}

}

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
        $this->addRole(User::ROLE_EDITOR);
        $this->addRole(User::ROLE_ORGANIZATION);
	}

	/**
	 * Setup resources
	 */
	protected function addResources(): void
	{

        $this->addResource('admin');
        $this->addResource('editor', 'admin');

        $this->addResource('basic', 'editor');
		$this->addResource('Admin:Home', "basic");
        $this->addResource('Admin:User:list', 'admin');
        $this->addResource('Admin:User:edit', 'admin');

        $this->addResource('Admin:BlogPost', 'editor');
        $this->addResource('Admin:BlogPost:list', 'editor');
        $this->addResource('Admin:BlogPost:add', 'editor');
        $this->addResource('Admin:BlogPost:edit', 'editor');
        $this->addResource('Admin:BlogTag:list', 'editor');
        $this->addResource('Admin:BlogTag:add', 'editor');
        $this->addResource('Admin:BlogTag:edit', 'editor');


        $this->addResource('Admin:Editor:approving', 'editor');
        $this->addResource('Admin:Editor', 'editor');
        $this->addResource('Admin:Editor:assign', 'editor');
        $this->addResource('Admin:Editor:edit', 'editor');

        $this->addResource('Admin:Organization:list', 'admin');

        $this->addResource('Admin:Organization:addBlog', 'basic');
        $this->addResource('Admin:BlogPost:my', 'basic');

	}

	/**
	 * Setup ACL
	 */
	protected function addPermissions(): void
	{
		$this->allow(User::ROLE_ADMIN, [
			'admin',
		]);

        $this->allow(User::ROLE_ORGANIZATION, [
            'basic',
        ]);

        $this->allow(User::ROLE_EDITOR, [
            'editor',
        ]);

	}

}

<?php

namespace App\Domain\Organization;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\User\UserRepository")
 * @ORM\Table(name="`organizations`")
 * @ORM\HasLifecycleCallbacks
 */
class Organization
{

}

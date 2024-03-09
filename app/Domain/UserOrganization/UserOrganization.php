<?php

namespace App\Domain\UserOrganization;

use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\UserOrganization\UserOrganizationRepository")
 * @ORM\Table(name="`user_organization`")
 * @ORM\HasLifecycleCallbacks
 */
class UserOrganization
{
    use TId;

    /** @ORM\Column(name="user_id", type="integer", length=11, nullable=FALSE, unique=false) */
    private ?int $userId;

    /** @ORM\Column(name="organization_id", type="integer", length=11, nullable=FALSE, unique=false) */
    private ?int $organizationId;

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getOrganizationId(): ?int
    {
        return $this->organizationId;
    }

    public function setOrganizationId(?int $organizationId): void
    {
        $this->organizationId = $organizationId;
    }


}

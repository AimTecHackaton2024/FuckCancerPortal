<?php declare(strict_types = 1);

namespace App\Domain\User;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TAdminautFields;
use App\Model\Database\Entity\TCreatedAt;
use App\Model\Database\Entity\TId;
use App\Model\Database\Entity\TUpdatedAt;
use App\Model\Database\Entity\TUuid;
use App\Model\Exception\Logic\InvalidArgumentException;
use App\Model\Security\Identity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\User\UserRepository")
 * @ORM\Table(name="`adminaut_user`")
 * @ORM\HasLifecycleCallbacks
 */
class User extends AbstractEntity
{

	use TId;
    use TAdminautFields;

	public const ROLE_ADMIN = 'admin';
	public const ROLE_EDITOR = 'editor';
    public const ROLE_ORGANIZATION = 'organization';

    public static array $rolesForSelect = [
        self::ROLE_ADMIN=> self::ROLE_ADMIN,
        self::ROLE_EDITOR => self::ROLE_EDITOR,
        self::ROLE_ORGANIZATION => self::ROLE_ORGANIZATION
        ];

	public const STATE_FRESH = 1;
	public const STATE_ACTIVATED = 2;
	public const STATE_BLOCKED = 3;

	public const STATES = [self::STATE_FRESH, self::STATE_BLOCKED, self::STATE_ACTIVATED];

	/** @ORM\Column(type="string", length=128, nullable=FALSE, unique=false) */
	private string $name;

    /** @ORM\Column(type="string", length=128, nullable=FALSE, unique=TRUE) */
    private string $email;

	/** @ORM\Column(type="string", length=128, nullable=FALSE, unique=false) */
	private string $password;

	/** @ORM\Column(type="boolean", nullable=FALSE, unique=TRUE) */
	private bool $passwordChangeOnNextLogon;

	/** @ORM\Column(type="string", length=128, nullable=FALSE, unique=FALSE) */
	private string $role;

    /** @ORM\Column(type="string", length=128, nullable=FALSE, unique=FALSE) */
    private string $language;

    /** @ORM\Column(type="integer", length=11, nullable=FALSE, unique=FALSE) */
    private int $status;

    /** @ORM\Column(type="string", length=255, nullable=TRUE, unique=FALSE) */
    private ?string $passwordRecoveryKey;

    /** @ORM\Column(type="datetime", nullable=TRUE, unique=FALSE) */
    private ?DateTime $passwordRecoveryExpiresAt;

    /** @ORM\Column(type="boolean", nullable=FALSE, unique=FALSE) */
    private bool $active;

    /** @ORM\Column(type="string", length=255, nullable=FALSE, unique=FALSE) */
    private string $dtype;

    /**
     * @ORM\Column(name="send_new_blog_notification", type="boolean", nullable=FALSE, unique=FALSE)
     */
    private bool $sendNewBlogNotification;

    public function isSendNewBlogNotification(): bool
    {
        return $this->sendNewBlogNotification;
    }

    public function setSendNewBlogNotification(bool $sendNewBlogNotification): void
    {
        $this->sendNewBlogNotification = $sendNewBlogNotification;
    }


	public function __construct()
	{
	}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool
     */
    public function isPasswordChangeOnNextLogon(): bool
    {
        return $this->passwordChangeOnNextLogon;
    }

    /**
     * @param bool $passwordChangeOnNextLogon
     */
    public function setPasswordChangeOnNextLogon(bool $passwordChangeOnNextLogon): void
    {
        $this->passwordChangeOnNextLogon = $passwordChangeOnNextLogon;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPasswordRecoveryKey(): ?string
    {
        return $this->passwordRecoveryKey;
    }

    /**
     * @param ?string $passwordRecoveryKey
     */
    public function setPasswordRecoveryKey(?string $passwordRecoveryKey): void
    {
        $this->passwordRecoveryKey = $passwordRecoveryKey;
    }

    /**
     * @return ?DateTime
     */
    public function getPasswordRecoveryExpiresAt(): ?DateTime
    {
        return $this->passwordRecoveryExpiresAt;
    }

    /**
     * @param ?DateTime $passwordRecoveryExpiresAt
     */
    public function setPasswordRecoveryExpiresAt(?DateTime $passwordRecoveryExpiresAt): void
    {
        $this->passwordRecoveryExpiresAt = $passwordRecoveryExpiresAt;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getDtype(): string
    {
        return $this->dtype;
    }

    /**
     * @param string $dtype
     */
    public function setDtype(string $dtype): void
    {
        $this->dtype = $dtype;
    }

	public function getGravatar(): string
	{
		return 'https://www.gravatar.com/avatar/' . md5($this->email);
	}

	public function toIdentity(): Identity
	{
		return new Identity($this->getId(), [$this->role], [
			'email' => $this->email,
			'name' => $this->name,
			'status' => $this->status,
		]);
	}

}

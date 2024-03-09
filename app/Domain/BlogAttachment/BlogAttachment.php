<?php

namespace App\Domain\BlogAttachment;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BlogAttachmentRepository")
 * @ORM\Table(name="`blog_attachments`")
 * @ORM\HasLifecycleCallbacks
 */
class BlogAttachment extends AbstractEntity
{
    use TId;
    /** @ORM\Column(type="string", length=255, nullable=FALSE, unique=false) */
    private string $name;
    /** @ORM\Column(type="string", length=255, nullable=FALSE, unique=false) */
    private string $mimeType;
    /** @ORM\Column(type="string", length=255, nullable=FALSE, unique=false) */
    private string $path;
    /** @ORM\Column(type="integer", length=11, nullable=FALSE, unique=false) */
    private int $size;

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
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }
}

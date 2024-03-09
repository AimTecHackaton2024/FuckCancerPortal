<?php

namespace App\Domain\Blog;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TAdminautFields;
use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\User\UserRepository")
 * @ORM\Table(name="`blog_posts`")
 * @ORM\HasLifecycleCallbacks
 */
class BlogPost extends AbstractEntity
{
    use TId;
    use TAdminautFields;

    /** @ORM\Column(name="photo_main", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photoMainId;

    /** @ORM\Column(name="photo_1", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo1Id;

    /** @ORM\Column(name="photo_2", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo2Id;

    /** @ORM\Column(name="photo_3", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo3Id;

    /** @ORM\Column(name="photo_4", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo4Id;

    /** @ORM\Column(name="title", type="string", length=255, nullable=FALSE, unique=false) */
    private string $title;

    /** @ORM\Column(name="status", type="string", length=255, nullable=FALSE, unique=false) */
    private string $status;

    /** @ORM\Column(name="date_published", type="date", nullable=TRUE, unique=false) */
    private ?\DateTime $publishedDate;

    /** @ORM\Column(name="perex", type="text", nullable=FALSE, unique=false) */
    private string $perex;

    /** @ORM\Column(name="article", type="string", nullable=FALSE, unique=false) */
    private string $article;

    /** @ORM\Column(name="youtube_video", type="string", length=255, nullable=FALSE, unique=false) */
    private string $youtubeVideoUrl;

    /**
     * @return int|null
     */
    public function getPhotoMainId(): ?int
    {
        return $this->photoMainId;
    }

    /**
     * @param int|null $photoMainId
     */
    public function setPhotoMainId(?int $photoMainId): void
    {
        $this->photoMainId = $photoMainId;
    }

    /**
     * @return int|null
     */
    public function getPhoto1Id(): ?int
    {
        return $this->photo1Id;
    }

    /**
     * @param int|null $photo1Id
     */
    public function setPhoto1Id(?int $photo1Id): void
    {
        $this->photo1Id = $photo1Id;
    }

    /**
     * @return int|null
     */
    public function getPhoto2Id(): ?int
    {
        return $this->photo2Id;
    }

    /**
     * @param int|null $photo2Id
     */
    public function setPhoto2Id(?int $photo2Id): void
    {
        $this->photo2Id = $photo2Id;
    }

    /**
     * @return int|null
     */
    public function getPhoto3Id(): ?int
    {
        return $this->photo3Id;
    }

    /**
     * @param int|null $photo3Id
     */
    public function setPhoto3Id(?int $photo3Id): void
    {
        $this->photo3Id = $photo3Id;
    }

    /**
     * @return int|null
     */
    public function getPhoto4Id(): ?int
    {
        return $this->photo4Id;
    }

    /**
     * @param int|null $photo4Id
     */
    public function setPhoto4Id(?int $photo4Id): void
    {
        $this->photo4Id = $photo4Id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime|null
     */
    public function getPublishedDate(): ?\DateTime
    {
        return $this->publishedDate;
    }

    /**
     * @param \DateTime|null $publishedDate
     */
    public function setPublishedDate(?\DateTime $publishedDate): void
    {
        $this->publishedDate = $publishedDate;
    }

    /**
     * @return string
     */
    public function getPerex(): string
    {
        return $this->perex;
    }

    /**
     * @param string $perex
     */
    public function setPerex(string $perex): void
    {
        $this->perex = $perex;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @param string $article
     */
    public function setArticle(string $article): void
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getYoutubeVideoUrl(): string
    {
        return $this->youtubeVideoUrl;
    }

    /**
     * @param string $youtubeVideoUrl
     */
    public function setYoutubeVideoUrl(string $youtubeVideoUrl): void
    {
        $this->youtubeVideoUrl = $youtubeVideoUrl;
    }
}

<?php

namespace App\Domain\BlogTag;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TAdminautFields;
use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\BlogTag\BlogTagRepository")
 * @ORM\Table(name="`blog_tag`")
 * @ORM\HasLifecycleCallbacks
 */
class BlogTag extends AbstractEntity
{
    use TId;

    /** @ORM\Column(name="title", type="string", nullable=FALSE, unique=false) */
    private string $title;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }



}

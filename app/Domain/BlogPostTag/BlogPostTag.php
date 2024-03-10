<?php

namespace App\Domain\BlogPostTag;

use App\Domain\Blog\BlogPost;
use App\Domain\BlogTag\BlogTag;
use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BlogPostTagRepository")
 * @ORM\Table(name="`blog_post_tag`")
 * @ORM\HasLifecycleCallbacks
 */
class BlogPostTag extends AbstractEntity
{
    use TId;

    /**
     * @var int
     * @ORM\Column(type="integer", length=11, nullable=false, unique=false)
     */
    private int $blogPostId;

    /**
     * @var int
     * @ORM\Column(type="integer", length=11, nullable=false, unique=false)
     */
    private int $blogTagId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Blog\BlogPost", inversedBy="postTags")
     * @ORM\JoinColumn(name="blog_post_id", referencedColumnName="id")
     */
    private BlogPost $blogPost;

    /**
     * @var BlogTag
     * @ORM\ManyToOne(targetEntity="App\Domain\BlogTag\BlogTag")
     * @ORM\JoinColumn(name="blog_tag_id", referencedColumnName="id")
     */
    private BlogTag $blogTag;

    public function __construct(BlogPost $post, BlogTag $tag)
    {
        $this->blogPost = $post;
        $this->blogTag = $tag;
    }

    public function getBlogTagId(): int
    {
        return $this->blogTagId;
    }

    public function getBlogTag(): BlogTag
    {
        return $this->blogTag;
    }
}

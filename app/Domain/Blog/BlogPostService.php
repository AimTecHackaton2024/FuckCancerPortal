<?php

namespace App\Domain\Blog;

use App\Domain\BlogAttachment\BlogAttachment;
use App\Domain\BlogPostTag\BlogPostTag;
use App\Domain\BlogTag\BlogTag;
use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;
use App\Model\Utils\FileSystem;
use Mockery\Exception;
use Nette\Caching\Storages\FileStorage;
use Nette\Http\FileUpload;

class BlogPostService
{
    private EntityManagerDecorator $em;
    private QueryBuilderManager $queryBuilderManager;

    public function __construct(
        EntityManagerDecorator $em,
        QueryBuilderManager    $queryBuilderManager,
    )
    {
        $this->em = $em;
        $this->queryBuilderManager = $queryBuilderManager;
    }

    public function getById(string|int $id): BlogPost
    {
        if (is_string($id))
        {
            $id = intval($id);
        }

        return $this->em->getBlogPostRepository()->get($id);
    }

    public function findById(int $id): ?BlogPost
    {
        return $this->em->getBlogPostRepository()->find($id);
    }

    public function getAll(): array
    {
        return $this->em->getBlogPostRepository()->findAll();
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(BlogPostQuery::getAll());
    }

    public function createBlogPost(array $data)
    {
        $post = new BlogPost();
        bdump($data);
        $post->setTitle($data['title']);
        $post->setArticle($data['article']);
        $post->setPerex($data['perex']);
        $post->setStatus($data['status']);
        $post->setPublishedDate($data['publishedDate']);
        $post->setYoutubeVideoUrl($data['youtubeVideoUrl']);

        /*
        foreach (['photoMain', 'photo1', 'photo2', 'photo3', 'photo4'] as $photoName)

            /** @var FileUpload $photoData *//*
            $photoData = $data[$photoName];
        if ($photoData !== null)
        {
            $photo = $post->getPhoto($photoName);
            if ($photo !== null)
            {
                FileSystem::delete($photo->getPath());
                $this->em->remove($photo);
            }

            $photo = new BlogAttachment();

            FileSystem::copy($photoData->getTemporaryFile(), '');
            // nahrani nove fotky a ulozeni entity
        }
        */

        $this->em->persist($post);
        $this->em->flush($post);
    }

    public function updateBlogPost(?BlogPost $post, array $data)
    {

        bdump($data);
        $post->setTitle($data['title']);
        $post->setArticle($data['article']);
        $post->setPerex($data['perex']);
        $post->setStatus($data['status']);
        $post->setPublishedDate($data['publishedDate']);
        $post->setYoutubeVideoUrl($data['youtubeVideoUrl']);

        $this->em->flush($post);
    }

    public function savePostTags(BlogPost $blogPost, array $tags): void
    {
        $this->em->createQueryBuilder()
            ->delete(BlogPostTag::class, 'bps')
            ->where('bps.blogPost = :post')
            ->setParameter('post', $blogPost)
            ->getQuery()
            ->execute()
        ;

        foreach ($tags as $tagId)
        {
            $tag = $this->em->getReference(BlogTag::class, $tagId);

            if($tag === null)
            {
                throw new Exception('Tag not found');
            }

            $blogPostTag = new BlogPostTag($blogPost, $tag);
            $this->em->persist($blogPostTag);
        }

        $this->em->flush();
    }

    public function getPostTagIds(BlogPost $post): array
    {
        $result = [];

        $tags = $this->em->getBlogPostTagRepository()->findBy(['blogPost' => $post]);

        foreach($tags as $tag)
        {
            $result[] = $tag->getId();
        }

        return $result;
    }

    public function getAllTagPairs(): array
    {
        $tags = $this->em->getBlogTagRepository()
            ->findAll()
        ;

        $result = [];
        foreach ($tags as $tag)
        {
            $result[$tag->getId()] = $tag->getTitle();
        }

        return $result;
    }
}

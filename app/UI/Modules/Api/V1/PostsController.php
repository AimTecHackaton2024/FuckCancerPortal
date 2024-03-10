<?php

namespace App\UI\Modules\Api\V1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\Domain\BlogPostTag\BlogPostTag;
use App\Domain\BlogTag\BlogTag;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @Path("/posts")
 */
class PostsController extends BaseV1Controller
{
    private BlogPostService $postService;

    public function __construct(
        BlogPostService $postService,
    )
    {
        $this->postService = $postService;
    }

    /**
     * @Path("/")
     * @Method("GET")
     * @param ApiRequest $request
     * @param ApiResponse $response
     * @return ApiResponse
     */
    public function index(ApiRequest $request, ApiResponse $response): ApiResponse
    {
        $page = $request->getQueryParam('page', 1);
        $tagFilter = $request->getQueryParam('tagFilter', null);

        /** @var QueryBuilder $qb */
        $qb = $this->postService->getAllDataSource();
        $qb->leftJoin('bp.postTags', 'pt')
            ->leftJoin('pt.blogTag', 'bt')
            ->addSelect('pt, bt');

        if($tagFilter !== null)
        {
            $qb->andWhere('pt.id = :tagFilter')
                ->setParameter('tagFilter', $tagFilter);
        }
        $query = $qb->getQuery();

        $pageSize = '10';
        $paginator = new Paginator($query);

        $totalItems = count($paginator);

        $pageCount = ceil($totalItems / $pageSize);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page - 1))
            ->setMaxResults($pageSize);

        $result = [];
        foreach ($paginator as $pageItem)
        {
            /** @var BlogPost $pageItem */
            $tags = [];

            foreach ($pageItem->getPostTags() as $tag)
            {
                /** @var BlogPostTag $tag */
                $tags[] = $tag->getBlogTag()->getTitle();
            }

            $result[] = [
                'title' => $pageItem->getTitle(),
                'photo_main' => $pageItem->getPhotoMain()?->getPath(),
                'perex' => $pageItem->getPerex(),
                'tags' => $tags,
            ];
        }

        $response = $response->writeJsonBody($result);

        return $response;
    }
}

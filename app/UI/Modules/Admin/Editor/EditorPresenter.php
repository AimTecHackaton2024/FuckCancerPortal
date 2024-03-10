<?php declare(strict_types = 1);

namespace App\UI\Modules\Admin\Editor;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\Domain\Order\Event\OrderCreated;
use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostForm;
use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostFormFactory;
use App\UI\Components\Admin\Blog\EditorBlogListGrid\EditorBlogListGrid;
use App\UI\Components\Admin\Blog\EditorBlogListGrid\EditorBlogListGridFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class EditorPresenter extends BaseAdminPresenter
{

    private EditorBlogListGridFactory $editorBlogListGridFactory;
    private BlogPostService $blogPostService;
    private BlogPostFormFactory $blogPostFormFactory;
    private ?BlogPost $blogPost = null;

    /**
     * @param EditorBlogListGridFactory $editorBlogListGridFactory
     */
    public function __construct(
        EditorBlogListGridFactory $editorBlogListGridFactory,
        BlogPostService $blogPostService,
        BlogPostFormFactory $blogPostFormFactory
    )
    {
        $this->editorBlogListGridFactory = $editorBlogListGridFactory;
        $this->blogPostService = $blogPostService;
        $this->blogPostFormFactory = $blogPostFormFactory;
    }

    public function createComponentEditorUnassignedBlogGrid(): EditorBlogListGrid
    {
        return $this->editorBlogListGridFactory->create(null);
    }

    public function createComponentEditorAssignedBlogGrid(): EditorBlogListGrid
    {
        return $this->editorBlogListGridFactory->create((int)$this->getUser()->getId());
    }

    public function createComponentEditBlogPostForm(): BlogPostForm
    {
        return $this->blogPostFormFactory->create($this->blogPost);
    }

    public function actionEdit(int $id)
    {
        $this->blogPost = $this->blogPostService->findById($id);

        if($this->blogPost === null)
        {
            throw new BadRequestException();
        }
    }

    public function actionAssign(int $id): void
    {
        if($this->getUser()->isAllowed('editor') === false)
        {
            $this->redirect(':Admin:Home:');
        }
        $this->blogPostService->assignForReview($id, $this->getUser()->getId());
        $this->flashSuccess("Přiřazení proběhlo úspěšně");
        $this->redirect(":approving");
    }


}

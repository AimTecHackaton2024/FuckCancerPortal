<?php

namespace App\UI\Components\Admin\Blog\BlogPostForm;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Nette\Utils\ArrayHash;

class BlogPostForm extends BaseComponent
{
    private BlogPostService $blogPostService;
    private ?BlogPost $blogPost;

    public function __construct(
        BlogPostService $blogPostService,
        ?BlogPost       $blogPost,
    )
    {
        $this->blogPostService = $blogPostService;
        $this->blogPost = $blogPost;
    }

    public function render(mixed $params = null): void
    {
        /** @var BaseForm $form */
        $form = $this['form'];

        if ($this->blogPost)
        {
            $form->setDefaults([
                'title'           => $this->blogPost->getTitle(),
                'article'         => $this->blogPost->getArticle(),
                'youtubeVideoUrl' => $this->blogPost->getYoutubeVideoUrl(),
            ]);
        }

        parent::render($params);
    }

    public function createComponentForm(): BaseForm
    {
        $form = new BaseForm();

        $form->addText('title', 'Titulek')
            ->setRequired(true)
        ;

        $form->addTextArea('article', 'Článek');

        $form->addDateTime('publishedDate', 'Publikováno');

        $form->addText('youtubeVideoUrl', 'Odkaz na YouTube video');

        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values)
    {
        $this->flashSuccess('Success');
    }
}

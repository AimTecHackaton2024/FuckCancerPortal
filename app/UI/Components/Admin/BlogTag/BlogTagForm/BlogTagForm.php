<?php

namespace App\UI\Components\Admin\BlogTag\BlogTagForm;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\Domain\BlogTag\BlogTag;
use App\Domain\BlogTag\BlogTagService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Nette\Utils\ArrayHash;

class BlogTagForm extends BaseComponent
{
    private BlogTagService $blogTagService;
    private ?BlogTag $blogTag;

    /**
     * @param BlogTagService $blogTagService
     */
    public function __construct(?BlogTag $blogTag, BlogTagService $blogTagService)
    {
        $this->blogTagService = $blogTagService;
        $this->blogTag = $blogTag;
    }

    public function render(mixed $params = null): void
    {
        /** @var BaseForm $form */
        $form = $this['form'];

        if ($this->blogTag)
        {
            $form->setDefaults([
                'title' => $this->blogTag->getTitle(),
            ]);
        }

        parent::render($params);
    }

    public function createComponentForm(): BaseForm
    {
        $form = new BaseForm();

        $form->addText('title', 'Titulek')
            ->setRequired("Titulek je povinný údaj")
        ;

        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values)
    {

        try {
            if($this->blogTag === null)
            {
                $this->blogTagService->saveTag($values['title']);

            }
            else
            {
                $this->blogTagService->updateTag($this->blogTag, $values['title']);
            }
        }
        catch (\Exception $e)
        {
            $this->flashError("Ukládání dat se nezdařilo");
        }

        $this->flashSuccess('Ukložení tagu proběhlo úspěšně');


        $this->presenter->redirect(':list');
    }
}

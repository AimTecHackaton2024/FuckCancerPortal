<?php

namespace App\UI\Components\Admin\Blog\BlogPostForm;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Exception;
use Nette\Forms\Rule;
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
                'perex'           => $this->blogPost->getPerex(),
                'status'          => $this->blogPost->getStatus(),
                'youtubeVideoUrl' => $this->blogPost->getYoutubeVideoUrl(),
                'publishedDate'   => $this->blogPost->getPublishedDate(),
                'postTags'        => $this->blogPostService->getPostTagIds($this->blogPost),
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

        $form->addTextArea('article', 'Článek')
            ->setRequired()
        ;

        $form->addTextArea('perex', 'Perex')
            ->setRequired()
        ;

        $form->addSelect('status', 'Status', [
            BlogPost::STATUS_NEW      => "Nový",
            BlogPost::STATUS_ASSIGNED => "Přiřazený",
            blogPost::STATUS_APPROVED => "Schválený",
        ]);

        $form->addMultiSelect('postTags', 'Kategorie', $this->blogPostService->getAllTagPairs());

        $form->addDateTime('publishedDate', 'Publikováno');

        $form->addText('youtubeVideoUrl', 'Odkaz na YouTube video');

        $form->addUpload('photoMain', 'Hlavní obrázek')->addRule($form::MimeType, 'Vstupní soubor musí být obrázek JPEG nebo PNG', ['image/png', 'image/jpeg']);
        $form->addUpload('photo1', 'Obrázek 1')->addRule($form::MimeType, 'Vstupní soubor musí být obrázek JPEG nebo PNG', ['image/png', 'image/jpeg']);
        $form->addUpload('photo2', 'Obrázek 2')->addRule($form::MimeType, 'Vstupní soubor musí být obrázek JPEG nebo PNG', ['image/png', 'image/jpeg']);
        $form->addUpload('photo3', 'Obrázek 3')->addRule($form::MimeType, 'Vstupní soubor musí být obrázek JPEG nebo PNG', ['image/png', 'image/jpeg']);
        $form->addUpload('photo4', 'Obrázek 4')->addRule($form::MimeType, 'Vstupní soubor musí být obrázek JPEG nebo PNG', ['image/png', 'image/jpeg']);

        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values)
    {
        $transformedData = [
            'title'           => $values['title'],
            'article'         => $values['article'],
            'perex'           => $values['perex'],
            'status'          => $values['status'],
            'publishedDate'   => $values['publishedDate'] !== null ? \DateTime::createFromImmutable($values['publishedDate']) : null,
            'youtubeVideoUrl' => empty($values['youtubeVideoUrl']) ? null : $values['youtubeVideoUrl'],
            'postTags'        => $values['postTags'],
        ];

        $transformedData['photoMain'] = $values['photoMain']->isOk() && $values['photoMain']->isImage() ? $values['photoMain'] : null;
        $transformedData['photo1'] = $values['photo1']->isOk() && $values['photo1']->isImage() ? $values['photo1'] : null;
        $transformedData['photo2'] = $values['photo2']->isOk() && $values['photo2']->isImage() ? $values['photo2'] : null;
        $transformedData['photo3'] = $values['photo3']->isOk() && $values['photo3']->isImage() ? $values['photo3'] : null;
        $transformedData['photo4'] = $values['photo4']->isOk() && $values['photo4']->isImage() ? $values['photo4'] : null;

        try
        {
            if ($this->blogPost)
            {
                $this->blogPostService->updateBlogPost($this->blogPost, $transformedData);
            }
            else
            {
                $this->blogPostService->createBlogPost($transformedData);
            }
        }
        catch (Exception $e)
        {
            $this->flashInfo($e);
            $this->flashError('Při ukládání se vyskytla chyba');
            $form->addError('Při ukládání se vyskytla chyba');
        }

        $this->flashSuccess('Příspěvek úspěšně uložen.');
        $this->presenter->redirect(':list');
    }


}

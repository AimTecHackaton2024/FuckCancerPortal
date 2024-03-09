<?php

namespace App\UI\Components\Base;

use App\Model\Logger\DBLogger;
use App\Model\Utils\FlashMessage;
use App\Modules\Base\BasePresenter;
use App\UI\Control\TComponentFlashMessage;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;
use Nette\Application\UI\Control;
use Nette\ComponentModel\IComponent;

class BaseComponent extends Control
{
    protected ?string $latteFile = null;
    private ?string $componentName = null;
    private ?string $componentNameWithPath = null;

    protected Translator $translator;

    use TComponentFlashMessage;

    public function render(mixed $params = null): void
    {
        if (empty($this->latteFile))
        {
            $this->latteFile = $this->getComponentNameWithPath();
        }


        if (isset($this['grid']) && $this->presenter instanceof BasePresenter)
        {
            /** @var BaseGrid $grid */
            $grid = $this['grid'];

            $grid->setPagination($this->presenter->configManager->isGridPaginationEnabled() && $grid->isPaginated());
        }

        $this->getTemplate()->setFile($this->latteFile . '.latte');
        $this->getTemplate()->componentName = $this->getComponentName();
        $this->getTemplate()->render();
    }

    public function getComponentNameWithPath(): ?string
    {
        if ($this->componentNameWithPath === null)
        {
            $fileName = $this->getReflection()->getFileName();
            if (!empty($fileName))
            {
                $this->componentNameWithPath = str_replace(".php", "", $fileName);
            }
        }

        return $this->componentNameWithPath;
    }

    public function getComponentName(): string
    {
        if ($this->componentName === null)
        {
            $this->componentName = $this->getReflection()->getShortName();
        }

        return $this->componentName;
    }

    public function addComponent(IComponent $component, ?string $name, ?string $insertBefore = null)
    {
        if ($component instanceof BaseComponent)
        {
            $component->onFlash[] = function(FlashMessage $flashMessage) {
                $this->onFlash($flashMessage);
            };
        }

        return parent::addComponent($component, $name, $insertBefore); // TODO: Change the autogenerated stub
    }

    protected function idTransform(?string $id = null): ?int
    {
        if ($id === null) return null;

        if (empty($id)) return null;

        if (!is_numeric($id)) return null;

        return intval($id);
    }
}

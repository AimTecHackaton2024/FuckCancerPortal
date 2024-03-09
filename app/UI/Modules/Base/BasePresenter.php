<?php declare(strict_types = 1);

namespace App\UI\Modules\Base;

use App\Domain\User\User;
use App\Domain\User\UserService;
use App\Model\Latte\TemplateProperty;
use App\Model\Security\SecurityUser;
use App\Model\Utils\FlashMessage;
use App\UI\Components\Base\BaseComponent;
use App\UI\Control\TFlashMessage;
use App\UI\Control\TModuleUtils;
use App\UI\DataGrid\BaseGrid;
use Contributte\Application\UI\Presenter\StructuredTemplates;
use Nette;
use Nette\Application\UI\Presenter;
use Nette\ComponentModel\IComponent;

/**
 * @property-read TemplateProperty $template
 * @property-read SecurityUser $user
 */
abstract class BasePresenter extends Presenter
{
    /** @var UserService $userService @inject */
    public UserService $userService;

    protected ?User $userEntity = null;

    public function startup()
    {
        parent::startup();

        if($this->user->isLoggedIn())
        {
            $this->userEntity = $this->userService->getById($this->user->getId());
            $this->template->userEntity = $this->userEntity;
        }


    }

    public function addComponent(IComponent $component, ?string $name, ?string $insertBefore = null)
    {
        if ($component instanceof BaseComponent)
        {
            $component->onFlash[] = function(FlashMessage $flashMessage) {
                $this->flash($flashMessage);
            };
        }

        $container = parent::addComponent($component, $name, $insertBefore);
        return $container;
    }

    use StructuredTemplates;
	use TFlashMessage;
	use TModuleUtils;

}

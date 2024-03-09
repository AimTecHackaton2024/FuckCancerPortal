<?php

namespace App\UI\Control;

use App\Model\Utils\FlashMessage;
use Contributte\Security\Auth\DebugAuthenticator;
use Tracy\Debugger;

trait TComponentFlashMessage
{
    /** @var callable[] */
    public array $onFlash;

    public function flashSuccess(string $message): void
    {
        bdump("test");
        $this->onFlash(new FlashMessage($message, FlashMessage::TYPE_SUCCESS));
    }

    public function flashWarning(string $message): void
    {
        $this->onFlash(new FlashMessage($message, FlashMessage::TYPE_WARNING));
    }

    public function flashInfo(string $message): void
    {
        $this->onFlash(new FlashMessage($message, FlashMessage::TYPE_INFO));
    }

    public function flashError(string $message): void
    {
        bdump("error");
        $this->onFlash(new FlashMessage($message, FlashMessage::TYPE_ERROR));
    }
}

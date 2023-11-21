<?php

namespace App\Model\Mail;

use Nette\Mail\Mailer;
use Nette\Mail\Message;
use Tracy\Debugger;
use Tracy\ILogger;

class FakeLogMailer implements SimpleMailer
{
public const MAIL_TITLE = 'Zpráva odeslaného emailu';
    public function send(Message $message): void
    {
        bd($message->generateMessage(), self::MAIL_TITLE);
    }
}
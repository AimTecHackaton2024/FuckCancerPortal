<?php

namespace App\Model\Mail;

use Nette\Mail\Mailer;
use Nette\Mail\Message;
use Tracy\Debugger;

class SMTPMailer implements SimpleMailer
{


    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Message $message): void
    {
        $this->mailer->send($message);
    }
}
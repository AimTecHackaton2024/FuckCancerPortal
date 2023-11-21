<?php

namespace App\Model\Mail;

use Nette\Mail\Message;

/**
 * Rozhranni pro modifikaci chovani emailu
 */
interface SimpleMailer
{

    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message): void;

}
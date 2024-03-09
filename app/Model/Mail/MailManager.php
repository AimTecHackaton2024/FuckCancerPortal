<?php

namespace App\Model\Mail;

use Nette;
use Nette\Mail\Message;

/**
 * Class for handling activities related to sending emails
 *
 * @package App\Model
 */
class MailManager
{
    use Nette\SmartObject;

    private SimpleMailer $simpleMailer;
    private string $baseUri;
    private string $mailFrom;

    public function __construct(
        string $baseUri,
        string $mailFrom,
        SimpleMailer $simpleMailer,
    )
    {
        $this->simpleMailer = $simpleMailer;
        $this->baseUri = $baseUri;
        $this->mailFrom = $mailFrom;
    }

    /**
     * Sending email for testing purpose
     *
     * @param string $email
     * @param string $link
     */
    public function sendTestEmail(string $email, string $link): void
    {
        $msg = new Message();
        $msg->setFrom("Xko <$this->mailFrom>")
            ->addTo($email)
            ->setSubject('Order Confirmation')
            ->setBody("Odkaz pro resetování hesla: " . $this->baseUri . $link)
        ;

        $this->simpleMailer->send($msg);
    }

    /**
     * Function sends email with recovery password token
     *
     * @param string $email
     * @param string $recoveryLink
     */
    public function sendForgetEmail(string $email, string $recoveryLink): void
    {

        $msg = new Message();
        $msg->setFrom('Xko <' . $this->mailFrom . '>')
            ->addTo($email)
            ->setSubject('Žádost o resetování hesla')
            ->setBody("Odkaz pro resetování hesla: " . $this->baseUri . $recoveryLink)
        ;

        $this->simpleMailer->send($msg);
    }
}

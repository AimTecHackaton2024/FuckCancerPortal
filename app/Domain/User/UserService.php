<?php

namespace App\Domain\User;

use App\Model\App;
use App\Model\Database\EntityManagerDecorator;
use App\Model\Database\QueryBuilderManager;
use App\Model\Mail\MailManager;
use App\Model\Security\Passwords;
use App\Model\Utils\DateTime;
use Exception;
use Nette\Application\UI\Presenter;

class UserService
{
    private EntityManagerDecorator $em;
    private QueryBuilderManager $queryBuilderManager;
    private Passwords $passwords;
    private MailManager $mailManager;

    public function __construct(
        EntityManagerDecorator $em,
        QueryBuilderManager $queryBuilderManager,
        Passwords $passwords,
        MailManager $mailManager
    )
    {
        $this->em = $em;
        $this->queryBuilderManager = $queryBuilderManager;
        $this->passwords = $passwords;
        $this->mailManager = $mailManager;
    }

    public function getById(int $id): User
    {
        return $this->em->getUserRepository()->get($id);
    }

    public function findById(int $id): ?User
    {
        return $this->em->getUserRepository()->find($id);
    }

    public function getAllDataSource(): mixed
    {
        return $this->queryBuilderManager->getQueryBuilder(UserQuery::getAll());
    }

    public function updateUser(?User $user, string $role, bool $send_new_blog_notification)
    {
        $user->setRole($role);
        $user->setSendNewBlogNotification($send_new_blog_notification);
        $this->em->flush($user);
    }

    public function proccessPasswordRecovery(string $email, Presenter $presenter): void
    {
        $this->em->beginTransaction();

        $token = '';
        $user = null;
        do
        {
            $token = md5(uniqid(strval(rand()), true));
            $user = $this->em->getUserRepository()
                ->findOneBy(['passwordRecoveryKey' => $token])
            ;
        }
        while ($user !== null);

        $user = $this->em->getUserRepository()
            ->findOneBy(['email' => $email, 'active' => 1], ['id' => 'DESC'])
        ;

        if ($user === null)
        {
            $this->em->rollback();
            return;
        }

        $user->setPasswordRecoveryKey($token);
        $datetime = (new DateTime())->modify('+ ' . App::RECOVERY_TOKEN_VALID_TIME);
        $user->setPasswordRecoveryExpiresAt($datetime);

        try{
            $this->em->persist($user);
            $this->em->flush();
            $this->mailManager->sendForgetEmail($user->getEmail(), $presenter->link("Sign:recovery", ['token' => $token]));
            $this->em->commit();
        }catch (Exception $e){
            $this->em->rollback();
        }
    }

    public function recoverPassword(User $user, string $password): void
    {
        $user->setPassword($this->passwords->hash($password));
        $user->setPasswordRecoveryKey(null);
        $user->setPasswordRecoveryExpiresAt(null);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function getUserByValidRecoveryToken( ?string $token): ?User
    {
        $user = $this->em->getUserRepository()->findOneBy(['passwordRecoveryKey' => $token]);

        if ($user === null)
        {
            return null;
        }

        if ($user->getPasswordRecoveryExpiresAt() < new \DateTime())
        {
            return null;
        }

        return $user;
    }
}

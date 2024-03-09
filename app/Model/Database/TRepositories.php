<?php

namespace App\Model\Database;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostRepository;
use App\Domain\BlogAttachment\BlogAttachment;
use App\Domain\BlogAttachment\BlogAttachmentRepository;
use App\Domain\BlogPostTag\BlogPostTag;
use App\Domain\BlogPostTag\BlogPostTagRepository;
use App\Domain\BlogTag\BlogTag;
use App\Domain\BlogTag\BlogTagRepository;
use App\Domain\Organization\Organization;
use App\Domain\Organization\OrganizationRepository;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Domain\UserOrganization\UserOrganization;
use App\Domain\UserOrganization\UserOrganizationRepository;


/**
 * @mixin EntityManagerDecorator
 */
trait TRepositories
{
    public function getUserRepository(): UserRepository
    {
        return $this->getRepository(User::class);
    }

    public function getBlogPostRepository(): BlogPostRepository
    {
        return $this->getRepository(BlogPost::class);
    }

    public function getOrganizationRepository(): OrganizationRepository
    {
        return $this->getRepository(Organization::class);
    }

    public function getUserOrganizationRepository(): UserOrganizationRepository
    {
        return $this->getRepository(UserOrganization::class);
    }

    public function getBlogAttachmentRepository(): BlogAttachmentRepository
    {
        return $this->getRepository(BlogAttachment::class);
    }

    public function getBlogTagRepository(): BlogTagRepository
    {
        return $this->getRepository(BlogTag::class);
    }

    public function getBlogPostTagRepository(): BlogPostTagRepository
    {
        return $this->getRepository(BlogPostTag::class);
    }
}

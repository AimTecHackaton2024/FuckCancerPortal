<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309004649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE IF EXISTS blog_attachments");

        $this->addSql("create table blog_attachments
                (
                    id          int auto_increment,
                    name        varchar(255) not null,
                    `mime_type` varchar(255) not null,
                    path        varchar(255) not null,
                    size        int          not null,
                    constraint blog_attachments_pk
                        primary key (id)
                );");

        $this->addSql("create table blog_posts
(
    id              int auto_increment
        primary key,
    photo_main      int          null,
    photo_1         int          null,
    photo_2         int          null,
    photo_3         int          null,
    photo_4         int          null,
    title           varchar(255) not null,
    status          varchar(255) not null,
    date_published  date         null,
    perex           longtext     not null,
    article         longtext     not null,
    youtube_video   varchar(255) null,
    organization_id int          null,
    author_id       int          not null,
    approving_id    int          null,
    constraint blog_posts_adminaut_user_id_fk
        foreign key (author_id) references adminaut_user (id),
    constraint blog_posts_adminaut_user_id_fk2
        foreign key (approving_id) references adminaut_user (id),
    constraint blog_posts_blog_attachments_id_fk
        foreign key (photo_main) references blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk2
        foreign key (photo_1) references blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk3
        foreign key (photo_2) references blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk4
        foreign key (photo_3) references blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk5
        foreign key (photo_4) references blog_attachments (id),
    constraint blog_posts_organizations_id_fk
        foreign key (organization_id) references organizations (id)
);


");


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

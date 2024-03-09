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
        $this->addSql("create table blog_attachments
                (
                    id          int auto_increment,
                    name        varchar(255) null,
                    `mime/type` varchar(255) null,
                    path        varchar(255) null,
                    size        int          null,
                    constraint blog_attachments_pk
                        primary key (id)
                );");

        $this->addSql("create table blog_posts
(
    id             int auto_increment
        primary key,
    photo_main     int          null,
    photo_1        int          null,
    photo_2        int          null,
    photo_3        int          null,
    photo_4        int          null,
    title          varchar(255) not null,
    status         varchar(255) not null,
    date_published date         null,
    perex          longtext     not null,
    article        longtext     not null,
    youtube_video  varchar(255) not null,
    inserted       datetime     not null,
    inserted_by    int          not null,
    updated        datetime     not null,
    updated_by     int          not null,
    deleted        tinyint(1)   not null,
    deleted_by     int          not null,
    deleted_data   longtext     null comment '(DC2Type:json_array)',
    active         tinyint(1)   not null,
    constraint UNIQ_78B2F93235806C06
        unique (photo_4),
    constraint UNIQ_78B2F9323E197F90
        unique (photo_main),
    constraint UNIQ_78B2F93245EA9889
        unique (photo_1),
    constraint UNIQ_78B2F932ABE4F9A5
        unique (photo_3),
    constraint UNIQ_78B2F932DCE3C933
        unique (photo_2),
    constraint blog_posts_blog_attachments_id_fk
        foreign key (photo_main) references FuckCancer.blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk2
        foreign key (photo_1) references FuckCancer.blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk3
        foreign key (photo_2) references FuckCancer.blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk4
        foreign key (photo_3) references FuckCancer.blog_attachments (id),
    constraint blog_posts_blog_attachments_id_fk5
        foreign key (photo_4) references FuckCancer.blog_attachments (id)
)
");


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

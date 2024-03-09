<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309085611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("create table blog_tag
(
    id    int auto_increment
        primary key,
    title varchar(255) not null,
    constraint blog_tag_unique
        unique (title)
);

");

        $this->addSql("
            create table blog_post_tag
(
    id           int auto_increment,
    blog_post_id int not null,
    blog_tag_id  int not null,
    constraint blog_post_tag_pk
        primary key (id),
    constraint blog_post_tag_blog_posts_id_fk
        foreign key (blog_post_id) references blog_posts (id),
    constraint blog_post_tag_blog_tag_id_fk
        foreign key (blog_tag_id) references blog_tag (id)
);


        ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309130510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("alter table adminaut_user add send_new_blog_notification tinyint(1) default 0 not null;");

        $this->addSql("
                alter table adminaut_user
                add organization_id int null;
                alter table adminaut_user
                add constraint adminaut_user_organizations_id_fk
                foreign key (organization_id) references organizations (id);
                ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

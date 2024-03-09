<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309081045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("create table user_organization
            (
                id              int auto_increment,
                user_id         int not null,
                organization_id int not null,
                constraint user_organization_pk
                    primary key (id),
                constraint user_organization_adminaut_user_id_fk
                    foreign key (user_id) references adminaut_user (id),
                constraint user_organization_organizations_id_fk
                    foreign key (organization_id) references organizations (id)
            );
            
            ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

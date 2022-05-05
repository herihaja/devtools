<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502124350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE entity_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entity_field (id INT NOT NULL, name VARCHAR(150) NOT NULL, field_type SMALLINT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE entity DROP field_type');
        $this->addSql('ALTER TABLE entity RENAME COLUMN entity TO name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE entity_field_id_seq CASCADE');
        $this->addSql('DROP TABLE entity_field');
        $this->addSql('ALTER TABLE entity ADD field_type SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE entity RENAME COLUMN name TO entity');
    }
}

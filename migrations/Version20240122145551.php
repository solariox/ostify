<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122145551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE streak_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE streak (id INT NOT NULL, streaker_id INT NOT NULL, score INT NOT NULL, character VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_198A1B29F3ADD1B0 ON streak (streaker_id)');
        $this->addSql('ALTER TABLE streak ADD CONSTRAINT FK_198A1B29F3ADD1B0 FOREIGN KEY (streaker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE streak_id_seq CASCADE');
        $this->addSql('ALTER TABLE streak DROP CONSTRAINT FK_198A1B29F3ADD1B0');
        $this->addSql('DROP TABLE streak');
    }
}

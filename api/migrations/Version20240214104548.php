<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214104548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE wine_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE wine_option (id INT NOT NULL, wine_id INT NOT NULL, description TEXT NOT NULL, alcohol DOUBLE PRECISION DEFAULT NULL, is_active BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A31F158228A2BD76 ON wine_option (wine_id)');
        $this->addSql('ALTER TABLE wine_option ADD CONSTRAINT FK_A31F158228A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wine ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE wine_option_id_seq CASCADE');
        $this->addSql('ALTER TABLE wine_option DROP CONSTRAINT FK_A31F158228A2BD76');
        $this->addSql('DROP TABLE wine_option');
        $this->addSql('CREATE SEQUENCE wine_id_seq');
        $this->addSql('SELECT setval(\'wine_id_seq\', (SELECT MAX(id) FROM wine))');
        $this->addSql('ALTER TABLE wine ALTER id SET DEFAULT nextval(\'wine_id_seq\')');
    }
}

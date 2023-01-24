<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124125432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer CHANGE name_company name_company VARCHAR(75) NOT NULL, CHANGE size_company size_company VARCHAR(75) NOT NULL, CHANGE location location VARCHAR(75) NOT NULL, CHANGE important_criteria important_criteria VARCHAR(245) DEFAULT NULL, CHANGE pc_specification pc_specification VARCHAR(245) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer CHANGE name_company name_company VARCHAR(25) NOT NULL, CHANGE size_company size_company VARCHAR(45) NOT NULL, CHANGE location location VARCHAR(45) NOT NULL, CHANGE important_criteria important_criteria VARCHAR(45) DEFAULT NULL, CHANGE pc_specification pc_specification VARCHAR(45) DEFAULT NULL');
    }
}

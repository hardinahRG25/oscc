<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031091341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD type_activity_id INT DEFAULT NULL, ADD business_sector_id INT DEFAULT NULL, ADD unit_manager_id INT DEFAULT NULL, ADD business_manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09CAD9B707 FOREIGN KEY (type_activity_id) REFERENCES type_activity (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09C7F1CE18 FOREIGN KEY (business_sector_id) REFERENCES business_sector (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E097B96A2A3 FOREIGN KEY (unit_manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09B89D3CC8 FOREIGN KEY (business_manager_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81398E09CAD9B707 ON customer (type_activity_id)');
        $this->addSql('CREATE INDEX IDX_81398E09C7F1CE18 ON customer (business_sector_id)');
        $this->addSql('CREATE INDEX IDX_81398E097B96A2A3 ON customer (unit_manager_id)');
        $this->addSql('CREATE INDEX IDX_81398E09B89D3CC8 ON customer (business_manager_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09CAD9B707');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09C7F1CE18');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E097B96A2A3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09B89D3CC8');
        $this->addSql('DROP INDEX IDX_81398E09CAD9B707 ON customer');
        $this->addSql('DROP INDEX IDX_81398E09C7F1CE18 ON customer');
        $this->addSql('DROP INDEX IDX_81398E097B96A2A3 ON customer');
        $this->addSql('DROP INDEX IDX_81398E09B89D3CC8 ON customer');
        $this->addSql('ALTER TABLE customer DROP type_activity_id, DROP business_sector_id, DROP unit_manager_id, DROP business_manager_id');
    }
}

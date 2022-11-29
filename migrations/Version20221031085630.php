<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031085630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09CAD9B707');
        $this->addSql('CREATE TABLE type_activity (id INT AUTO_INCREMENT NOT NULL, name_activity VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE customer_type_activity');
        $this->addSql('ALTER TABLE business_sector DROP description_secteur, CHANGE name_sector name_sector VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E097B96A2A3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09B89D3CC8');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09C7F1CE18');
        $this->addSql('DROP INDEX IDX_81398E09CAD9B707 ON customer');
        $this->addSql('DROP INDEX IDX_81398E09C7F1CE18 ON customer');
        $this->addSql('DROP INDEX IDX_81398E09B89D3CC8 ON customer');
        $this->addSql('DROP INDEX IDX_81398E097B96A2A3 ON customer');
        $this->addSql('ALTER TABLE customer ADD type_company VARCHAR(25) NOT NULL, DROP type_activity_id, DROP business_sector_id, DROP unit_manager_id, DROP business_manager_id');
        $this->addSql('ALTER TABLE user ADD child_number INT NOT NULL, ADD image_name VARCHAR(100) DEFAULT NULL, ADD city VARCHAR(55) DEFAULT NULL, ADD district VARCHAR(55) DEFAULT NULL, ADD contact_secondary VARCHAR(100) DEFAULT NULL, DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_type_activity (id INT AUTO_INCREMENT NOT NULL, name_type_activity VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE type_activity');
        $this->addSql('ALTER TABLE business_sector ADD description_secteur LONGTEXT DEFAULT NULL, CHANGE name_sector name_sector VARCHAR(75) NOT NULL');
        $this->addSql('ALTER TABLE customer ADD type_activity_id INT DEFAULT NULL, ADD business_sector_id INT DEFAULT NULL, ADD unit_manager_id INT DEFAULT NULL, ADD business_manager_id INT DEFAULT NULL, DROP type_company');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E097B96A2A3 FOREIGN KEY (unit_manager_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09B89D3CC8 FOREIGN KEY (business_manager_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09C7F1CE18 FOREIGN KEY (business_sector_id) REFERENCES business_sector (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09CAD9B707 FOREIGN KEY (type_activity_id) REFERENCES customer_type_activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_81398E09CAD9B707 ON customer (type_activity_id)');
        $this->addSql('CREATE INDEX IDX_81398E09C7F1CE18 ON customer (business_sector_id)');
        $this->addSql('CREATE INDEX IDX_81398E09B89D3CC8 ON customer (business_manager_id)');
        $this->addSql('CREATE INDEX IDX_81398E097B96A2A3 ON customer (unit_manager_id)');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(55) NOT NULL, DROP child_number, DROP image_name, DROP city, DROP district, DROP contact_secondary');
    }
}

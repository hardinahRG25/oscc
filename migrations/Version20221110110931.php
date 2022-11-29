<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110110931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission_stack_tech_language (mission_id INT NOT NULL, stack_tech_language_id INT NOT NULL, INDEX IDX_7F440D3FBE6CAE90 (mission_id), INDEX IDX_7F440D3F2D485365 (stack_tech_language_id), PRIMARY KEY(mission_id, stack_tech_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission_stack_tech_language ADD CONSTRAINT FK_7F440D3FBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_stack_tech_language ADD CONSTRAINT FK_7F440D3F2D485365 FOREIGN KEY (stack_tech_language_id) REFERENCES stack_tech_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer CHANGE stack_tech stack_tech LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission_stack_tech_language DROP FOREIGN KEY FK_7F440D3FBE6CAE90');
        $this->addSql('ALTER TABLE mission_stack_tech_language DROP FOREIGN KEY FK_7F440D3F2D485365');
        $this->addSql('DROP TABLE mission_stack_tech_language');
        $this->addSql('ALTER TABLE customer CHANGE stack_tech stack_tech LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}

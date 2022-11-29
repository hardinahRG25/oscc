<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110102922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_stack_tech_language (customer_id INT NOT NULL, stack_tech_language_id INT NOT NULL, INDEX IDX_2B07FB909395C3F3 (customer_id), INDEX IDX_2B07FB902D485365 (stack_tech_language_id), PRIMARY KEY(customer_id, stack_tech_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_stack_tech_language ADD CONSTRAINT FK_2B07FB909395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_stack_tech_language ADD CONSTRAINT FK_2B07FB902D485365 FOREIGN KEY (stack_tech_language_id) REFERENCES stack_tech_language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_stack_tech_language DROP FOREIGN KEY FK_2B07FB909395C3F3');
        $this->addSql('ALTER TABLE customer_stack_tech_language DROP FOREIGN KEY FK_2B07FB902D485365');
        $this->addSql('DROP TABLE customer_stack_tech_language');
    }
}

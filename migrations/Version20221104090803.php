<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104090803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD manager_id INT DEFAULT NULL, DROP manager');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649783E3463 ON user (manager_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649783E3463');
        $this->addSql('DROP INDEX IDX_8D93D649783E3463 ON user');
        $this->addSql('ALTER TABLE user ADD manager VARCHAR(255) NOT NULL, DROP manager_id');
    }
}

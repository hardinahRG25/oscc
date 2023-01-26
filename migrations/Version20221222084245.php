<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222084245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_university (user_id INT NOT NULL, university_id INT NOT NULL, INDEX IDX_71D4300A76ED395 (user_id), INDEX IDX_71D4300309D1878 (university_id), PRIMARY KEY(user_id, university_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_university ADD CONSTRAINT FK_71D4300A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_university ADD CONSTRAINT FK_71D4300309D1878 FOREIGN KEY (university_id) REFERENCES university (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_university DROP FOREIGN KEY FK_71D4300A76ED395');
        $this->addSql('ALTER TABLE user_university DROP FOREIGN KEY FK_71D4300309D1878');
        $this->addSql('DROP TABLE user_university');
    }
}

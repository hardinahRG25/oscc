<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205181850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_sector (id INT AUTO_INCREMENT NOT NULL, name_sector VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, type_activity_id INT DEFAULT NULL, business_sector_id INT DEFAULT NULL, unit_manager_id INT DEFAULT NULL, business_manager_id INT DEFAULT NULL, name_company VARCHAR(25) NOT NULL, size_company VARCHAR(45) NOT NULL, location VARCHAR(45) NOT NULL, team_structure LONGTEXT NOT NULL, day_off VARCHAR(45) DEFAULT NULL, cra VARCHAR(75) DEFAULT NULL, work_time VARCHAR(45) DEFAULT NULL, annual_closure VARCHAR(45) DEFAULT NULL, important_criteria VARCHAR(45) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, pc_specification VARCHAR(45) DEFAULT NULL, date_create_info DATE DEFAULT NULL, contacts VARCHAR(255) NOT NULL, update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_collaboration DATE DEFAULT NULL, stack_tech LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_81398E09CAD9B707 (type_activity_id), INDEX IDX_81398E09C7F1CE18 (business_sector_id), INDEX IDX_81398E097B96A2A3 (unit_manager_id), INDEX IDX_81398E09B89D3CC8 (business_manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_stack_tech_language (customer_id INT NOT NULL, stack_tech_language_id INT NOT NULL, INDEX IDX_2B07FB909395C3F3 (customer_id), INDEX IDX_2B07FB902D485365 (stack_tech_language_id), PRIMARY KEY(customer_id, stack_tech_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_care (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, date_share DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', note_collaboration LONGTEXT DEFAULT NULL, cust_relationship_info VARCHAR(100) DEFAULT NULL, cust_relationship_note NUMERIC(5, 2) DEFAULT NULL, business_info VARCHAR(100) DEFAULT NULL, business_note NUMERIC(5, 2) DEFAULT NULL, cust_back_info VARCHAR(100) NOT NULL, cust_back_note NUMERIC(5, 2) DEFAULT NULL, employee_back_info VARCHAR(100) DEFAULT NULL, employee_back_note NUMERIC(5, 2) DEFAULT NULL, average_note VARCHAR(100) DEFAULT NULL, average_score NUMERIC(5, 2) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_35820C329395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_mission_evaluation (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, customer_id INT NOT NULL, technical_skills VARCHAR(45) NOT NULL, productivity VARCHAR(45) NOT NULL, rigour VARCHAR(45) NOT NULL, autonomy VARCHAR(45) NOT NULL, communication VARCHAR(45) NOT NULL, reactivity VARCHAR(45) NOT NULL, disponibility VARCHAR(45) NOT NULL, involvement VARCHAR(45) NOT NULL, proactive VARCHAR(45) NOT NULL, initiative VARCHAR(45) NOT NULL, teamwork VARCHAR(45) NOT NULL, versality VARCHAR(45) NOT NULL, notes LONGTEXT DEFAULT NULL, date_create_info DATETIME NOT NULL, examiner VARCHAR(45) NOT NULL, INDEX IDX_1D4CFFEE8C03F15C (employee_id), INDEX IDX_1D4CFFEE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_novity_evaluation (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, customer_id INT NOT NULL, integration VARCHAR(45) NOT NULL, model VARCHAR(45) NOT NULL, communication VARCHAR(45) NOT NULL, professionnal VARCHAR(45) NOT NULL, excellence VARCHAR(45) NOT NULL, audacity VARCHAR(45) NOT NULL, humanity VARCHAR(45) NOT NULL, examiner VARCHAR(45) NOT NULL, notes LONGTEXT DEFAULT NULL, date_creation_info DATETIME NOT NULL, INDEX IDX_948EDD188C03F15C (employee_id), INDEX IDX_948EDD189395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, customer_id INT NOT NULL, job VARCHAR(45) NOT NULL, date_start DATE NOT NULL, date_end DATE DEFAULT NULL, mission_type VARCHAR(75) NOT NULL, reason_contract_end VARCHAR(200) DEFAULT NULL, date_create_info DATETIME NOT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_9067F23C8C03F15C (employee_id), INDEX IDX_9067F23C9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_stack_tech_language (mission_id INT NOT NULL, stack_tech_language_id INT NOT NULL, INDEX IDX_7F440D3FBE6CAE90 (mission_id), INDEX IDX_7F440D3F2D485365 (stack_tech_language_id), PRIMARY KEY(mission_id, stack_tech_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mood_employee (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, employee_id INT NOT NULL, date_mood DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', customer_back LONGTEXT DEFAULT NULL, actions VARCHAR(100) DEFAULT NULL, note NUMERIC(5, 2) DEFAULT NULL, remark LONGTEXT DEFAULT NULL, self_notation NUMERIC(5, 2) DEFAULT NULL, self_remark LONGTEXT DEFAULT NULL, novity_note NUMERIC(5, 2) DEFAULT NULL, novity_back LONGTEXT DEFAULT NULL, novity_remark LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_921BED409395C3F3 (customer_id), INDEX IDX_921BED408C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stack_tech_language (id INT AUTO_INCREMENT NOT NULL, name_language VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, objective VARCHAR(75) NOT NULL, training VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, source VARCHAR(45) NOT NULL, progress VARCHAR(45) NOT NULL, note LONGTEXT DEFAULT NULL, date_create_info DATETIME DEFAULT NULL, INDEX IDX_D5128A8F8C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_activity (id INT AUTO_INCREMENT NOT NULL, name_activity VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, manager_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, image_name VARCHAR(100) DEFAULT NULL, date_entry DATE DEFAULT NULL, country VARCHAR(25) NOT NULL, qualification VARCHAR(255) NOT NULL, contract_type VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, matrimonial_status VARCHAR(25) NOT NULL, address VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, contacts VARCHAR(255) NOT NULL, tech_dominant_cv VARCHAR(255) NOT NULL, tech_master VARCHAR(255) NOT NULL, tech_active VARCHAR(125) NOT NULL, tech_others VARCHAR(255) DEFAULT NULL, other_skills VARCHAR(255) DEFAULT NULL, skills_evolution VARCHAR(255) DEFAULT NULL, english_level VARCHAR(25) NOT NULL, original_company VARCHAR(25) DEFAULT NULL, cv_observations VARCHAR(255) DEFAULT NULL, risk_anticipation VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, perspective VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', child_number INT NOT NULL, city VARCHAR(55) DEFAULT NULL, district VARCHAR(55) DEFAULT NULL, contact_secondary VARCHAR(100) DEFAULT NULL, job VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09CAD9B707 FOREIGN KEY (type_activity_id) REFERENCES type_activity (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09C7F1CE18 FOREIGN KEY (business_sector_id) REFERENCES business_sector (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E097B96A2A3 FOREIGN KEY (unit_manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09B89D3CC8 FOREIGN KEY (business_manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_stack_tech_language ADD CONSTRAINT FK_2B07FB909395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_stack_tech_language ADD CONSTRAINT FK_2B07FB902D485365 FOREIGN KEY (stack_tech_language_id) REFERENCES stack_tech_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_care ADD CONSTRAINT FK_35820C329395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE employee_mission_evaluation ADD CONSTRAINT FK_1D4CFFEE8C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employee_mission_evaluation ADD CONSTRAINT FK_1D4CFFEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE employee_novity_evaluation ADD CONSTRAINT FK_948EDD188C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employee_novity_evaluation ADD CONSTRAINT FK_948EDD189395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C8C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE mission_stack_tech_language ADD CONSTRAINT FK_7F440D3FBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_stack_tech_language ADD CONSTRAINT FK_7F440D3F2D485365 FOREIGN KEY (stack_tech_language_id) REFERENCES stack_tech_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mood_employee ADD CONSTRAINT FK_921BED409395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE mood_employee ADD CONSTRAINT FK_921BED408C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F8C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09CAD9B707');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09C7F1CE18');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E097B96A2A3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09B89D3CC8');
        $this->addSql('ALTER TABLE customer_stack_tech_language DROP FOREIGN KEY FK_2B07FB909395C3F3');
        $this->addSql('ALTER TABLE customer_stack_tech_language DROP FOREIGN KEY FK_2B07FB902D485365');
        $this->addSql('ALTER TABLE customer_care DROP FOREIGN KEY FK_35820C329395C3F3');
        $this->addSql('ALTER TABLE employee_mission_evaluation DROP FOREIGN KEY FK_1D4CFFEE8C03F15C');
        $this->addSql('ALTER TABLE employee_mission_evaluation DROP FOREIGN KEY FK_1D4CFFEE9395C3F3');
        $this->addSql('ALTER TABLE employee_novity_evaluation DROP FOREIGN KEY FK_948EDD188C03F15C');
        $this->addSql('ALTER TABLE employee_novity_evaluation DROP FOREIGN KEY FK_948EDD189395C3F3');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C8C03F15C');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C9395C3F3');
        $this->addSql('ALTER TABLE mission_stack_tech_language DROP FOREIGN KEY FK_7F440D3FBE6CAE90');
        $this->addSql('ALTER TABLE mission_stack_tech_language DROP FOREIGN KEY FK_7F440D3F2D485365');
        $this->addSql('ALTER TABLE mood_employee DROP FOREIGN KEY FK_921BED409395C3F3');
        $this->addSql('ALTER TABLE mood_employee DROP FOREIGN KEY FK_921BED408C03F15C');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F8C03F15C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649783E3463');
        $this->addSql('DROP TABLE business_sector');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_stack_tech_language');
        $this->addSql('DROP TABLE customer_care');
        $this->addSql('DROP TABLE employee_mission_evaluation');
        $this->addSql('DROP TABLE employee_novity_evaluation');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_stack_tech_language');
        $this->addSql('DROP TABLE mood_employee');
        $this->addSql('DROP TABLE stack_tech_language');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE type_activity');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

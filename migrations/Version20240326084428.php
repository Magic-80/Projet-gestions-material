<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326084428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE borrowing (id INT AUTO_INCREMENT NOT NULL, manage_id INT DEFAULT NULL, borrow_id INT DEFAULT NULL, relate_to_id INT DEFAULT NULL, training_program_id INT DEFAULT NULL, student_id INT DEFAULT NULL, borrow_at DATETIME DEFAULT NULL, expected_return_date DATETIME DEFAULT NULL, actual_return_date DATETIME DEFAULT NULL, comment LONGTEXT NOT NULL, INDEX IDX_226E5897F1AF8971 (manage_id), INDEX IDX_226E5897D4C006C8 (borrow_id), INDEX IDX_226E5897E8BF6915 (relate_to_id), INDEX IDX_226E58978406BD6C (training_program_id), INDEX IDX_226E5897CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles VARCHAR(255) NOT NULL, deactivate TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, material_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, serial_number VARCHAR(255) DEFAULT NULL, tag_number VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_7CBE759574D6573C (material_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_program (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897F1AF8971 FOREIGN KEY (manage_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897D4C006C8 FOREIGN KEY (borrow_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897E8BF6915 FOREIGN KEY (relate_to_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E58978406BD6C FOREIGN KEY (training_program_id) REFERENCES training_program (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759574D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897F1AF8971');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897D4C006C8');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897E8BF6915');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E58978406BD6C');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897CB944F1A');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759574D6573C');
        $this->addSql('DROP TABLE borrowing');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_type');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE training_program');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219190817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897BC6DCCD5');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897CFBF73EB');
        $this->addSql('DROP INDEX IDX_226E5897CFBF73EB ON borrowing');
        $this->addSql('DROP INDEX IDX_226E5897BC6DCCD5 ON borrowing');
        $this->addSql('ALTER TABLE borrowing ADD borrow_id INT DEFAULT NULL, ADD training_program_id INT DEFAULT NULL, ADD student_id INT DEFAULT NULL, DROP make_id, DROP concern_id');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897D4C006C8 FOREIGN KEY (borrow_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E58978406BD6C FOREIGN KEY (training_program_id) REFERENCES training_program (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_226E5897D4C006C8 ON borrowing (borrow_id)');
        $this->addSql('CREATE INDEX IDX_226E58978406BD6C ON borrowing (training_program_id)');
        $this->addSql('CREATE INDEX IDX_226E5897CB944F1A ON borrowing (student_id)');
        $this->addSql('ALTER TABLE material ADD material_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759574D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id)');
        $this->addSql('CREATE INDEX IDX_7CBE759574D6573C ON material (material_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897D4C006C8');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E58978406BD6C');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897CB944F1A');
        $this->addSql('DROP INDEX IDX_226E5897D4C006C8 ON borrowing');
        $this->addSql('DROP INDEX IDX_226E58978406BD6C ON borrowing');
        $this->addSql('DROP INDEX IDX_226E5897CB944F1A ON borrowing');
        $this->addSql('ALTER TABLE borrowing ADD make_id INT DEFAULT NULL, ADD concern_id INT DEFAULT NULL, DROP borrow_id, DROP training_program_id, DROP student_id');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897BC6DCCD5 FOREIGN KEY (concern_id) REFERENCES training_program (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897CFBF73EB FOREIGN KEY (make_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_226E5897CFBF73EB ON borrowing (make_id)');
        $this->addSql('CREATE INDEX IDX_226E5897BC6DCCD5 ON borrowing (concern_id)');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759574D6573C');
        $this->addSql('DROP INDEX IDX_7CBE759574D6573C ON material');
        $this->addSql('ALTER TABLE material DROP material_type_id');
    }
}

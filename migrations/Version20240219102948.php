<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219102948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing ADD manage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897F1AF8971 FOREIGN KEY (manage_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_226E5897F1AF8971 ON borrowing (manage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897F1AF8971');
        $this->addSql('DROP INDEX IDX_226E5897F1AF8971 ON borrowing');
        $this->addSql('ALTER TABLE borrowing DROP manage_id');
    }
}

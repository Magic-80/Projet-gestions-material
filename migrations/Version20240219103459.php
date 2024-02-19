<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219103459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing ADD make_id INT DEFAULT NULL, ADD relate_to_id INT DEFAULT NULL, ADD concern_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897CFBF73EB FOREIGN KEY (make_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897E8BF6915 FOREIGN KEY (relate_to_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897BC6DCCD5 FOREIGN KEY (concern_id) REFERENCES training_program (id)');
        $this->addSql('CREATE INDEX IDX_226E5897CFBF73EB ON borrowing (make_id)');
        $this->addSql('CREATE INDEX IDX_226E5897E8BF6915 ON borrowing (relate_to_id)');
        $this->addSql('CREATE INDEX IDX_226E5897BC6DCCD5 ON borrowing (concern_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897CFBF73EB');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897E8BF6915');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897BC6DCCD5');
        $this->addSql('DROP INDEX IDX_226E5897CFBF73EB ON borrowing');
        $this->addSql('DROP INDEX IDX_226E5897E8BF6915 ON borrowing');
        $this->addSql('DROP INDEX IDX_226E5897BC6DCCD5 ON borrowing');
        $this->addSql('ALTER TABLE borrowing DROP make_id, DROP relate_to_id, DROP concern_id');
    }
}

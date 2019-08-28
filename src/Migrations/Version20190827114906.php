<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190827114906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rule ADD games_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rule ADD CONSTRAINT FK_46D8ACCC97FFC673 FOREIGN KEY (games_id) REFERENCES game (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46D8ACCC97FFC673 ON rule (games_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rule DROP FOREIGN KEY FK_46D8ACCC97FFC673');
        $this->addSql('DROP INDEX UNIQ_46D8ACCC97FFC673 ON rule');
        $this->addSql('ALTER TABLE rule DROP games_id');
    }
}

<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902145928 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, places VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE process ADD process_place_id INT NOT NULL');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D1896FB57FC98 FOREIGN KEY (process_place_id) REFERENCES places (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_861D18965C7C81F3 ON process (process_number)');
        $this->addSql('CREATE INDEX IDX_861D1896FB57FC98 ON process (process_place_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE process DROP FOREIGN KEY FK_861D1896FB57FC98');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP INDEX UNIQ_861D18965C7C81F3 ON process');
        $this->addSql('DROP INDEX IDX_861D1896FB57FC98 ON process');
        $this->addSql('ALTER TABLE process DROP process_place_id');
    }
}

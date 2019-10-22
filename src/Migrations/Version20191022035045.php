<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191022035045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address ADD city_id INT NOT NULL, ADD uf_id INT NOT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F818BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81705D2C5F FOREIGN KEY (uf_id) REFERENCES uf (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F818BAC62AF ON address (city_id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81705D2C5F ON address (uf_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F818BAC62AF');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81705D2C5F');
        $this->addSql('DROP INDEX IDX_D4E6F818BAC62AF ON address');
        $this->addSql('DROP INDEX IDX_D4E6F81705D2C5F ON address');
        $this->addSql('ALTER TABLE address DROP city_id, DROP uf_id');
    }
}
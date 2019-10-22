<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191022030653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uf (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(200) NOT NULL, number INT NOT NULL, complement VARCHAR(100) DEFAULT NULL, district VARCHAR(100) NOT NULL, cep VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE barber ADD barber_shop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE barber ADD CONSTRAINT FK_7C48A9A41A43DFA4 FOREIGN KEY (barber_shop_id) REFERENCES barber_shop (id)');
        $this->addSql('CREATE INDEX IDX_7C48A9A41A43DFA4 ON barber (barber_shop_id)');
        $this->addSql('ALTER TABLE barber_shop ADD address_id INT NOT NULL, ADD name VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE barber_shop ADD CONSTRAINT FK_B988B9E2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B988B9E2F5B7AF75 ON barber_shop (address_id)');
        $this->addSql('ALTER TABLE customer ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09F5B7AF75 ON customer (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE barber_shop DROP FOREIGN KEY FK_B988B9E2F5B7AF75');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09F5B7AF75');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE uf');
        $this->addSql('DROP TABLE address');
        $this->addSql('ALTER TABLE barber DROP FOREIGN KEY FK_7C48A9A41A43DFA4');
        $this->addSql('DROP INDEX IDX_7C48A9A41A43DFA4 ON barber');
        $this->addSql('ALTER TABLE barber DROP barber_shop_id');
        $this->addSql('DROP INDEX UNIQ_B988B9E2F5B7AF75 ON barber_shop');
        $this->addSql('ALTER TABLE barber_shop DROP address_id, DROP name');
        $this->addSql('DROP INDEX UNIQ_81398E09F5B7AF75 ON customer');
        $this->addSql('ALTER TABLE customer DROP address_id');
    }
}

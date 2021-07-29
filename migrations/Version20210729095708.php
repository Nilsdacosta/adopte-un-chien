<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729095708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, street LONGTEXT DEFAULT NULL, zipcode LONGTEXT NOT NULL, city LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisement (id INT AUTO_INCREMENT NOT NULL, announcer_id INT NOT NULL, title LONGTEXT NOT NULL, update_date DATE NOT NULL, is_active TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_C95F6AEE3EC97830 (announcer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, request_id INT DEFAULT NULL, content LONGTEXT NOT NULL, date_of_sending DATE NOT NULL, INDEX IDX_B6BD307F427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, adopter_id INT NOT NULL, date_of_request DATE NOT NULL, INDEX IDX_3B978F9FA1FBF71B (advertisement_id), INDEX IDX_3B978F9FA0D47673 (adopter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE3EC97830 FOREIGN KEY (announcer_id) REFERENCES announcer (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA0D47673 FOREIGN KEY (adopter_id) REFERENCES adopter (id)');
        $this->addSql('ALTER TABLE adopter ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopter ADD CONSTRAINT FK_A6ECDA1DF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_A6ECDA1DF5B7AF75 ON adopter (address_id)');
        $this->addSql('ALTER TABLE announcer ADD category_id INT NOT NULL, ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF3F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_4C80ACF312469DE2 ON announcer (category_id)');
        $this->addSql('CREATE INDEX IDX_4C80ACF3F5B7AF75 ON announcer (address_id)');
        $this->addSql('ALTER TABLE dog ADD advertisement_id INT NOT NULL, ADD sex TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('CREATE INDEX IDX_812C397DA1FBF71B ON dog (advertisement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopter DROP FOREIGN KEY FK_A6ECDA1DF5B7AF75');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF3F5B7AF75');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DA1FBF71B');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FA1FBF71B');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF312469DE2');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F427EB8A5');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE advertisement');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP INDEX IDX_A6ECDA1DF5B7AF75 ON adopter');
        $this->addSql('ALTER TABLE adopter DROP address_id');
        $this->addSql('DROP INDEX IDX_4C80ACF312469DE2 ON announcer');
        $this->addSql('DROP INDEX IDX_4C80ACF3F5B7AF75 ON announcer');
        $this->addSql('ALTER TABLE announcer DROP category_id, DROP address_id');
        $this->addSql('DROP INDEX IDX_812C397DA1FBF71B ON dog');
        $this->addSql('ALTER TABLE dog DROP advertisement_id, DROP sex');
    }
}

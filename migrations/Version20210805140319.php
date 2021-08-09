<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805140319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F427EB8A5');
        $this->addSql('CREATE TABLE contact_request (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, adopter_id INT NOT NULL, date_of_request DATE NOT NULL, INDEX IDX_A1B8AE1EA1FBF71B (advertisement_id), INDEX IDX_A1B8AE1EA0D47673 (adopter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_request ADD CONSTRAINT FK_A1B8AE1EA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE contact_request ADD CONSTRAINT FK_A1B8AE1EA0D47673 FOREIGN KEY (adopter_id) REFERENCES adopter (id)');
        $this->addSql('DROP TABLE request');
        $this->addSql('ALTER TABLE message ADD is_read TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F427EB8A5 FOREIGN KEY (request_id) REFERENCES contact_request (id)');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F427EB8A5');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, adopter_id INT NOT NULL, date_of_request DATE NOT NULL, INDEX IDX_3B978F9FA0D47673 (adopter_id), INDEX IDX_3B978F9FA1FBF71B (advertisement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA0D47673 FOREIGN KEY (adopter_id) REFERENCES adopter (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE contact_request');
        $this->addSql('ALTER TABLE message DROP is_read');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

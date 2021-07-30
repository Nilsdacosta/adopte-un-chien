<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729100544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopter ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopter ADD CONSTRAINT FK_A6ECDA1DF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_A6ECDA1DF5B7AF75 ON adopter (address_id)');
        $this->addSql('ALTER TABLE advertisement ADD announcer_id INT NOT NULL');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE3EC97830 FOREIGN KEY (announcer_id) REFERENCES announcer (id)');
        $this->addSql('CREATE INDEX IDX_C95F6AEE3EC97830 ON advertisement (announcer_id)');
        $this->addSql('ALTER TABLE announcer ADD category_id INT NOT NULL, ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF3F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_4C80ACF312469DE2 ON announcer (category_id)');
        $this->addSql('CREATE INDEX IDX_4C80ACF3F5B7AF75 ON announcer (address_id)');
        $this->addSql('ALTER TABLE dog ADD advertisement_id INT NOT NULL, ADD sex TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('CREATE INDEX IDX_812C397DA1FBF71B ON dog (advertisement_id)');
        $this->addSql('ALTER TABLE request ADD adopter_id INT NOT NULL, ADD date_of_request DATE NOT NULL');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA0D47673 FOREIGN KEY (adopter_id) REFERENCES adopter (id)');
        $this->addSql('CREATE INDEX IDX_3B978F9FA0D47673 ON request (adopter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopter DROP FOREIGN KEY FK_A6ECDA1DF5B7AF75');
        $this->addSql('DROP INDEX IDX_A6ECDA1DF5B7AF75 ON adopter');
        $this->addSql('ALTER TABLE adopter DROP address_id');
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEE3EC97830');
        $this->addSql('DROP INDEX IDX_C95F6AEE3EC97830 ON advertisement');
        $this->addSql('ALTER TABLE advertisement DROP announcer_id');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF312469DE2');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF3F5B7AF75');
        $this->addSql('DROP INDEX IDX_4C80ACF312469DE2 ON announcer');
        $this->addSql('DROP INDEX IDX_4C80ACF3F5B7AF75 ON announcer');
        $this->addSql('ALTER TABLE announcer DROP category_id, DROP address_id');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DA1FBF71B');
        $this->addSql('DROP INDEX IDX_812C397DA1FBF71B ON dog');
        $this->addSql('ALTER TABLE dog DROP advertisement_id, DROP sex');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FA0D47673');
        $this->addSql('DROP INDEX IDX_3B978F9FA0D47673 ON request');
        $this->addSql('ALTER TABLE request DROP adopter_id, DROP date_of_request');
    }
}

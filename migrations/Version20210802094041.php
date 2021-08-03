<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802094041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, street LONGTEXT DEFAULT NULL, zipcode LONGTEXT NOT NULL, city LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adopter (id INT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, firstname VARCHAR(50) DEFAULT NULL, INDEX IDX_A6ECDA1DF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisement (id INT AUTO_INCREMENT NOT NULL, announcer_id INT NOT NULL, title LONGTEXT NOT NULL, update_date DATE NOT NULL, is_active TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_C95F6AEE3EC97830 (announcer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE announcer (id INT NOT NULL, category_id INT NOT NULL, address_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_4C80ACF312469DE2 (category_id), INDEX IDX_4C80ACF3F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed_dog (breed_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_7AEFF8DCA8B4A30F (breed_id), INDEX IDX_7AEFF8DC634DFEB (dog_id), PRIMARY KEY(breed_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT NOT NULL, name VARCHAR(255) NOT NULL, date_ob DATE DEFAULT NULL, history LONGTEXT NOT NULL, lof TINYINT(1) NOT NULL, accept_cats TINYINT(1) NOT NULL, accept_dogs TINYINT(1) NOT NULL, is_adopted TINYINT(1) NOT NULL, sex TINYINT(1) NOT NULL, INDEX IDX_812C397DA1FBF71B (advertisement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, request_id INT DEFAULT NULL, content LONGTEXT NOT NULL, date_of_sending DATE NOT NULL, INDEX IDX_B6BD307F427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, path VARCHAR(100) NOT NULL, INDEX IDX_16DB4F89634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, adopter_id INT NOT NULL, date_of_request DATE NOT NULL, INDEX IDX_3B978F9FA1FBF71B (advertisement_id), INDEX IDX_3B978F9FA0D47673 (adopter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, userType VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adopter ADD CONSTRAINT FK_A6ECDA1DF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE adopter ADD CONSTRAINT FK_A6ECDA1DBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE3EC97830 FOREIGN KEY (announcer_id) REFERENCES announcer (id)');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF3F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breed_dog ADD CONSTRAINT FK_7AEFF8DCA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breed_dog ADD CONSTRAINT FK_7AEFF8DC634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA0D47673 FOREIGN KEY (adopter_id) REFERENCES adopter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopter DROP FOREIGN KEY FK_A6ECDA1DF5B7AF75');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF3F5B7AF75');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FA0D47673');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DA1FBF71B');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FA1FBF71B');
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEE3EC97830');
        $this->addSql('ALTER TABLE breed_dog DROP FOREIGN KEY FK_7AEFF8DCA8B4A30F');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF312469DE2');
        $this->addSql('ALTER TABLE breed_dog DROP FOREIGN KEY FK_7AEFF8DC634DFEB');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89634DFEB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F427EB8A5');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adopter DROP FOREIGN KEY FK_A6ECDA1DBF396750');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF3BF396750');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adopter');
        $this->addSql('DROP TABLE advertisement');
        $this->addSql('DROP TABLE announcer');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE breed_dog');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE user');
    }
}

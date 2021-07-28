<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728095747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adopter (id INT NOT NULL, name VARCHAR(50) DEFAULT NULL, firstname VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE announcer (id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, path VARCHAR(100) NOT NULL, INDEX IDX_16DB4F89634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, userType VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adopter ADD CONSTRAINT FK_A6ECDA1DBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcer ADD CONSTRAINT FK_4C80ACF3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE dog ADD date_ob DATE DEFAULT NULL, ADD history LONGTEXT NOT NULL, ADD lof TINYINT(1) NOT NULL, ADD accept_cats TINYINT(1) NOT NULL, ADD accept_dogs TINYINT(1) NOT NULL, ADD is_adopted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adopter DROP FOREIGN KEY FK_A6ECDA1DBF396750');
        $this->addSql('ALTER TABLE announcer DROP FOREIGN KEY FK_4C80ACF3BF396750');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adopter');
        $this->addSql('DROP TABLE announcer');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE dog DROP date_ob, DROP history, DROP lof, DROP accept_cats, DROP accept_dogs, DROP is_adopted');
    }
}

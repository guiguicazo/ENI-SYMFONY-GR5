<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220822143548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_date (utilisateur_id INT NOT NULL, date_id INT NOT NULL, INDEX IDX_631F5B40FB88E14F (utilisateur_id), INDEX IDX_631F5B40B897366B (date_id), PRIMARY KEY(utilisateur_id, date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_date ADD CONSTRAINT FK_631F5B40FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_date ADD CONSTRAINT FK_631F5B40B897366B FOREIGN KEY (date_id) REFERENCES date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE date ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_AA9E377AFB88E14F ON date (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur ADD utilisateurcampus_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B39FE6E91E FOREIGN KEY (utilisateurcampus_id) REFERENCES campus (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B39FE6E91E ON utilisateur (utilisateurcampus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur_date DROP FOREIGN KEY FK_631F5B40FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_date DROP FOREIGN KEY FK_631F5B40B897366B');
        $this->addSql('DROP TABLE utilisateur_date');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AFB88E14F');
        $this->addSql('DROP INDEX IDX_AA9E377AFB88E14F ON date');
        $this->addSql('ALTER TABLE date DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B39FE6E91E');
        $this->addSql('DROP INDEX IDX_1D1C63B39FE6E91E ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP utilisateurcampus_id');
    }
}

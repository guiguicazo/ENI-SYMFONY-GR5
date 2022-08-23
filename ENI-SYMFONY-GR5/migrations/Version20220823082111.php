<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823082111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AFB88E14F');
        $this->addSql('CREATE TABLE date_user (date_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AD4D5FBDB897366B (date_id), INDEX IDX_AD4D5FBDA76ED395 (user_id), PRIMARY KEY(date_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE date_user ADD CONSTRAINT FK_AD4D5FBDB897366B FOREIGN KEY (date_id) REFERENCES date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE date_user ADD CONSTRAINT FK_AD4D5FBDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B33256915B');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B39FE6E91E');
        $this->addSql('ALTER TABLE utilisateur_date DROP FOREIGN KEY FK_631F5B40FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_date DROP FOREIGN KEY FK_631F5B40B897366B');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_date');
        $this->addSql('DROP INDEX IDX_AA9E377AFB88E14F ON date');
        $this->addSql('ALTER TABLE date ADD organisateur_id INT DEFAULT NULL, DROP utilisateur_id');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AD936B2FA FOREIGN KEY (organisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AA9E377AD936B2FA ON date (organisateur_id)');
        $this->addSql('ALTER TABLE user ADD id_campus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492F68E9C6 FOREIGN KEY (id_campus_id) REFERENCES campus (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492F68E9C6 ON user (id_campus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, utilisateurcampus_id INT NOT NULL, relation_id INT NOT NULL, username VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(12) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, administrateur TINYINT(1) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_1D1C63B39FE6E91E (utilisateurcampus_id), UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), INDEX IDX_1D1C63B33256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur_date (utilisateur_id INT NOT NULL, date_id INT NOT NULL, INDEX IDX_631F5B40FB88E14F (utilisateur_id), INDEX IDX_631F5B40B897366B (date_id), PRIMARY KEY(utilisateur_id, date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33256915B FOREIGN KEY (relation_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B39FE6E91E FOREIGN KEY (utilisateurcampus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE utilisateur_date ADD CONSTRAINT FK_631F5B40FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_date ADD CONSTRAINT FK_631F5B40B897366B FOREIGN KEY (date_id) REFERENCES date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE date_user DROP FOREIGN KEY FK_AD4D5FBDB897366B');
        $this->addSql('ALTER TABLE date_user DROP FOREIGN KEY FK_AD4D5FBDA76ED395');
        $this->addSql('DROP TABLE date_user');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AD936B2FA');
        $this->addSql('DROP INDEX IDX_AA9E377AD936B2FA ON date');
        $this->addSql('ALTER TABLE date ADD utilisateur_id INT NOT NULL, DROP organisateur_id');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_AA9E377AFB88E14F ON date (utilisateur_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492F68E9C6');
        $this->addSql('DROP INDEX IDX_8D93D6492F68E9C6 ON user');
        $this->addSql('ALTER TABLE user DROP id_campus_id');
    }
}

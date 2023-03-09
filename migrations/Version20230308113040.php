<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308113040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, type_abonnement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, INDEX IDX_351268BB813AF326 (type_abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement_user (abonnement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F4A0F513F1D74413 (abonnement_id), INDEX IDX_F4A0F513A76ED395 (user_id), PRIMARY KEY(abonnement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_mot (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, INDEX IDX_E977251859027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT NOT NULL, dernier_passage INT NOT NULL, liste_mot_id INT DEFAULT NULL, niveau VARCHAR(255) NOT NULL, INDEX IDX_D87F7E0C52E60369 (liste_mot_id), PRIMARY KEY(id, dernier_passage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom_theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, date_souscription DATE NOT NULL, date_dernier_paiement DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D6496C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB813AF326 FOREIGN KEY (type_abonnement_id) REFERENCES type_abonnement (id)');
        $this->addSql('ALTER TABLE abonnement_user ADD CONSTRAINT FK_F4A0F513F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abonnement_user ADD CONSTRAINT FK_F4A0F513A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_mot ADD CONSTRAINT FK_E977251859027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C52E60369 FOREIGN KEY (liste_mot_id) REFERENCES liste_mot (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB813AF326');
        $this->addSql('ALTER TABLE abonnement_user DROP FOREIGN KEY FK_F4A0F513F1D74413');
        $this->addSql('ALTER TABLE abonnement_user DROP FOREIGN KEY FK_F4A0F513A76ED395');
        $this->addSql('ALTER TABLE liste_mot DROP FOREIGN KEY FK_E977251859027487');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C52E60369');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE abonnement_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE liste_mot');
        $this->addSql('DROP TABLE mot');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('DROP TABLE user');
    }
}

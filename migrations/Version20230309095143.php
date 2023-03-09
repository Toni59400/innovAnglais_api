<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309095143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mot_categorie (mot_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_B5FD31F563977652 (mot_id), INDEX IDX_B5FD31F5BCF5E72D (categorie_id), PRIMARY KEY(mot_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_liste_mot (mot_id INT NOT NULL, liste_mot_id INT NOT NULL, INDEX IDX_15F7C2D963977652 (mot_id), INDEX IDX_15F7C2D952E60369 (liste_mot_id), PRIMARY KEY(mot_id, liste_mot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_mot (mot_source INT NOT NULL, mot_target INT NOT NULL, INDEX IDX_E4918C1157867127 (mot_source), INDEX IDX_E4918C114E6321A8 (mot_target), PRIMARY KEY(mot_source, mot_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_abonnement (user_id INT NOT NULL, abonnement_id INT NOT NULL, INDEX IDX_9275AE57A76ED395 (user_id), INDEX IDX_9275AE57F1D74413 (abonnement_id), PRIMARY KEY(user_id, abonnement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mot_categorie ADD CONSTRAINT FK_B5FD31F563977652 FOREIGN KEY (mot_id) REFERENCES mot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_categorie ADD CONSTRAINT FK_B5FD31F5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_liste_mot ADD CONSTRAINT FK_15F7C2D963977652 FOREIGN KEY (mot_id) REFERENCES mot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_liste_mot ADD CONSTRAINT FK_15F7C2D952E60369 FOREIGN KEY (liste_mot_id) REFERENCES liste_mot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_mot ADD CONSTRAINT FK_E4918C1157867127 FOREIGN KEY (mot_source) REFERENCES mot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_mot ADD CONSTRAINT FK_E4918C114E6321A8 FOREIGN KEY (mot_target) REFERENCES mot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_abonnement ADD CONSTRAINT FK_9275AE57A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_abonnement ADD CONSTRAINT FK_9275AE57F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_categorie DROP FOREIGN KEY FK_B5FD31F563977652');
        $this->addSql('ALTER TABLE mot_categorie DROP FOREIGN KEY FK_B5FD31F5BCF5E72D');
        $this->addSql('ALTER TABLE mot_liste_mot DROP FOREIGN KEY FK_15F7C2D963977652');
        $this->addSql('ALTER TABLE mot_liste_mot DROP FOREIGN KEY FK_15F7C2D952E60369');
        $this->addSql('ALTER TABLE mot_mot DROP FOREIGN KEY FK_E4918C1157867127');
        $this->addSql('ALTER TABLE mot_mot DROP FOREIGN KEY FK_E4918C114E6321A8');
        $this->addSql('ALTER TABLE user_abonnement DROP FOREIGN KEY FK_9275AE57A76ED395');
        $this->addSql('ALTER TABLE user_abonnement DROP FOREIGN KEY FK_9275AE57F1D74413');
        $this->addSql('DROP TABLE mot_categorie');
        $this->addSql('DROP TABLE mot_liste_mot');
        $this->addSql('DROP TABLE mot_mot');
        $this->addSql('DROP TABLE user_abonnement');
    }
}

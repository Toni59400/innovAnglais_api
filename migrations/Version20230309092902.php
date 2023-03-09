<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309092902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE faire_test (utilisateur_id INT NOT NULL, test_id INT NOT NULL, resultat VARCHAR(255) NOT NULL, INDEX IDX_DB7994D7FB88E14F (utilisateur_id), INDEX IDX_DB7994D71E5D0459 (test_id), PRIMARY KEY(utilisateur_id, test_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE faire_test ADD CONSTRAINT FK_DB7994D7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE faire_test ADD CONSTRAINT FK_DB7994D71E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE faire_test DROP FOREIGN KEY FK_DB7994D7FB88E14F');
        $this->addSql('ALTER TABLE faire_test DROP FOREIGN KEY FK_DB7994D71E5D0459');
        $this->addSql('DROP TABLE faire_test');
    }
}

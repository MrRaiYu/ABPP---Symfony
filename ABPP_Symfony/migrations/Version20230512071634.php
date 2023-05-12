<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512071634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise_specialite (entreprise_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_4841672AA4AEAFEA (entreprise_id), INDEX IDX_4841672A2195E0F0 (specialite_id), PRIMARY KEY(entreprise_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_specialite ADD CONSTRAINT FK_4841672AA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_specialite ADD CONSTRAINT FK_4841672A2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D81742195E0F0');
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D8174A4AEAFEA');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE specialite_entreprise');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE specialite_entreprise (specialite_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_EA0D8174A4AEAFEA (entreprise_id), INDEX IDX_EA0D81742195E0F0 (specialite_id), PRIMARY KEY(specialite_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D81742195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D8174A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_specialite DROP FOREIGN KEY FK_4841672AA4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_specialite DROP FOREIGN KEY FK_4841672A2195E0F0');
        $this->addSql('DROP TABLE entreprise_specialite');
    }
}

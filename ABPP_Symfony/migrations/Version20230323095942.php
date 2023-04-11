<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323095942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, spe_lib VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite_entreprise (specialite_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_EA0D81742195E0F0 (specialite_id), INDEX IDX_EA0D8174A4AEAFEA (entreprise_id), PRIMARY KEY(specialite_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D81742195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D8174A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6074FAEB6C');
        $this->addSql('DROP INDEX IDX_D19FA6074FAEB6C ON entreprise');
        $this->addSql('ALTER TABLE entreprise CHANGE pays_id pays_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6074FAEB6C FOREIGN KEY (pays_id_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_D19FA6074FAEB6C ON entreprise (pays_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D81742195E0F0');
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D8174A4AEAFEA');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE specialite_entreprise');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6074FAEB6C');
        $this->addSql('DROP INDEX IDX_D19FA6074FAEB6C ON entreprise');
        $this->addSql('ALTER TABLE entreprise CHANGE pays_id_id pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6074FAEB6C FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_D19FA6074FAEB6C ON entreprise (pays_id)');
    }
}

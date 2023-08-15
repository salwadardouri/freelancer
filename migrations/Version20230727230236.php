<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727230236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1BFF3DC52');
        $this->addSql('DROP TABLE gategorie');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP INDEX IDX_132AD0D1BFF3DC52 ON offre_emploi');
        $this->addSql('ALTER TABLE offre_emploi ADD categorie VARCHAR(255) NOT NULL, DROP gategorie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gategorie (id INT AUTO_INCREMENT NOT NULL, titrecategory VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, valid DATETIME NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_emploi ADD gategorie_id INT DEFAULT NULL, DROP categorie');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1BFF3DC52 FOREIGN KEY (gategorie_id) REFERENCES gategorie (id)');
        $this->addSql('CREATE INDEX IDX_132AD0D1BFF3DC52 ON offre_emploi (gategorie_id)');
    }
}

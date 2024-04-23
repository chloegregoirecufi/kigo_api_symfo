<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423123400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FC18272');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC18272');
        $this->addSql('CREATE TABLE post_competence (post_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_B7AC61BE4B89032C (post_id), INDEX IDX_B7AC61BE15761DAB (competence_id), PRIMARY KEY(post_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_filiere (post_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_1338EAAD4B89032C (post_id), INDEX IDX_1338EAAD180AA129 (filiere_id), PRIMARY KEY(post_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_competence ADD CONSTRAINT FK_B7AC61BE4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_competence ADD CONSTRAINT FK_B7AC61BE15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_filiere ADD CONSTRAINT FK_1338EAAD4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_filiere ADD CONSTRAINT FK_1338EAAD180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA94B89032C');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP INDEX IDX_94D4687FC18272 ON competence');
        $this->addSql('ALTER TABLE competence DROP projet_id');
        $this->addSql('DROP INDEX UNIQ_B6BD307FC18272 ON message');
        $this->addSql('ALTER TABLE message CHANGE projet_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F4B89032C ON message (post_id)');
        $this->addSql('ALTER TABLE post ADD is_active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, is_finish TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_50159CA94B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA94B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_competence DROP FOREIGN KEY FK_B7AC61BE4B89032C');
        $this->addSql('ALTER TABLE post_competence DROP FOREIGN KEY FK_B7AC61BE15761DAB');
        $this->addSql('ALTER TABLE post_filiere DROP FOREIGN KEY FK_1338EAAD4B89032C');
        $this->addSql('ALTER TABLE post_filiere DROP FOREIGN KEY FK_1338EAAD180AA129');
        $this->addSql('DROP TABLE post_competence');
        $this->addSql('DROP TABLE post_filiere');
        $this->addSql('ALTER TABLE competence ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_94D4687FC18272 ON competence (projet_id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4B89032C');
        $this->addSql('DROP INDEX IDX_B6BD307F4B89032C ON message');
        $this->addSql('ALTER TABLE message CHANGE post_id projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307FC18272 ON message (projet_id)');
        $this->addSql('ALTER TABLE post DROP is_active');
    }
}

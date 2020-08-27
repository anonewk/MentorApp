<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621163259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE goal ADD mentoring_contract_id INT NOT NULL');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E5E76FEF9 FOREIGN KEY (mentoring_contract_id) REFERENCES mentoring_contract (id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E5E76FEF9 ON goal (mentoring_contract_id)');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E5E76FEF9');
        $this->addSql('DROP INDEX IDX_FCDCEB2E5E76FEF9 ON goal');
        $this->addSql('ALTER TABLE goal DROP mentoring_contract_id');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621165226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
        $this->addSql('ALTER TABLE user_skill ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_skill ADD CONSTRAINT FK_BCFF1F2FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BCFF1F2FA76ED395 ON user_skill (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user_skill DROP FOREIGN KEY FK_BCFF1F2FA76ED395');
        $this->addSql('DROP INDEX IDX_BCFF1F2FA76ED395 ON user_skill');
        $this->addSql('ALTER TABLE user_skill DROP user_id');
    }
}

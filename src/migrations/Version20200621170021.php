<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621170021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request ADD user_sender_id INT NOT NULL, ADD user_recipient_id INT NOT NULL, CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE mentoring_contract_request ADD CONSTRAINT FK_BA4BD406F6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mentoring_contract_request ADD CONSTRAINT FK_BA4BD40669E3F37A FOREIGN KEY (user_recipient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BA4BD406F6C43E79 ON mentoring_contract_request (user_sender_id)');
        $this->addSql('CREATE INDEX IDX_BA4BD40669E3F37A ON mentoring_contract_request (user_recipient_id)');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request DROP FOREIGN KEY FK_BA4BD406F6C43E79');
        $this->addSql('ALTER TABLE mentoring_contract_request DROP FOREIGN KEY FK_BA4BD40669E3F37A');
        $this->addSql('DROP INDEX IDX_BA4BD406F6C43E79 ON mentoring_contract_request');
        $this->addSql('DROP INDEX IDX_BA4BD40669E3F37A ON mentoring_contract_request');
        $this->addSql('ALTER TABLE mentoring_contract_request DROP user_sender_id, DROP user_recipient_id, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

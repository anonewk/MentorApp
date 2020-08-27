<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621171040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment ADD user_id INT NOT NULL, ADD assigned_group_id INT NOT NULL, CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE group_assignment ADD CONSTRAINT FK_E7082508A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE group_assignment ADD CONSTRAINT FK_E70825088359DF4E FOREIGN KEY (assigned_group_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_E7082508A76ED395 ON group_assignment (user_id)');
        $this->addSql('CREATE INDEX IDX_E70825088359DF4E ON group_assignment (assigned_group_id)');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment DROP FOREIGN KEY FK_E7082508A76ED395');
        $this->addSql('ALTER TABLE group_assignment DROP FOREIGN KEY FK_E70825088359DF4E');
        $this->addSql('DROP INDEX IDX_E7082508A76ED395 ON group_assignment');
        $this->addSql('DROP INDEX IDX_E70825088359DF4E ON group_assignment');
        $this->addSql('ALTER TABLE group_assignment DROP user_id, DROP assigned_group_id, CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

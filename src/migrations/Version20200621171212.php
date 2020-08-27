<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621171212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_invitation_user (group_invitation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE0187C4FCB4B4B2 (group_invitation_id), INDEX IDX_FE0187C4A76ED395 (user_id), PRIMARY KEY(group_invitation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_invitation_user ADD CONSTRAINT FK_FE0187C4FCB4B4B2 FOREIGN KEY (group_invitation_id) REFERENCES group_invitation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_invitation_user ADD CONSTRAINT FK_FE0187C4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE group_invitation ADD assigned_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE group_invitation ADD CONSTRAINT FK_26D000108359DF4E FOREIGN KEY (assigned_group_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_26D000108359DF4E ON group_invitation (assigned_group_id)');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE group_invitation_user');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE group_invitation DROP FOREIGN KEY FK_26D000108359DF4E');
        $this->addSql('DROP INDEX IDX_26D000108359DF4E ON group_invitation');
        $this->addSql('ALTER TABLE group_invitation DROP assigned_group_id');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621170300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mentoring_session_mentoring_contract (mentoring_session_id INT NOT NULL, mentoring_contract_id INT NOT NULL, INDEX IDX_5F3B6820D00A4615 (mentoring_session_id), INDEX IDX_5F3B68205E76FEF9 (mentoring_contract_id), PRIMARY KEY(mentoring_session_id, mentoring_contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mentoring_session_mentoring_contract ADD CONSTRAINT FK_5F3B6820D00A4615 FOREIGN KEY (mentoring_session_id) REFERENCES mentoring_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mentoring_session_mentoring_contract ADD CONSTRAINT FK_5F3B68205E76FEF9 FOREIGN KEY (mentoring_contract_id) REFERENCES mentoring_contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mentoring_session_mentoring_contract');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

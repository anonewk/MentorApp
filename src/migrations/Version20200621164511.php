<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621164511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistance_request_skill (assistance_request_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_566D7D7CD04CB59E (assistance_request_id), INDEX IDX_566D7D7C5585C142 (skill_id), PRIMARY KEY(assistance_request_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistance_request_skill ADD CONSTRAINT FK_566D7D7CD04CB59E FOREIGN KEY (assistance_request_id) REFERENCES assistance_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assistance_request_skill ADD CONSTRAINT FK_566D7D7C5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE assistance_request_skill');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

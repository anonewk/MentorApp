<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621165036 extends AbstractMigration
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
        $this->addSql('ALTER TABLE mentoring_contract_subscription ADD user_id INT NOT NULL, ADD mentoring_contract_id INT NOT NULL');
        $this->addSql('ALTER TABLE mentoring_contract_subscription ADD CONSTRAINT FK_C5D7CC4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mentoring_contract_subscription ADD CONSTRAINT FK_C5D7CC4F5E76FEF9 FOREIGN KEY (mentoring_contract_id) REFERENCES mentoring_contract (id)');
        $this->addSql('CREATE INDEX IDX_C5D7CC4FA76ED395 ON mentoring_contract_subscription (user_id)');
        $this->addSql('CREATE INDEX IDX_C5D7CC4F5E76FEF9 ON mentoring_contract_subscription (mentoring_contract_id)');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_subscription DROP FOREIGN KEY FK_C5D7CC4FA76ED395');
        $this->addSql('ALTER TABLE mentoring_contract_subscription DROP FOREIGN KEY FK_C5D7CC4F5E76FEF9');
        $this->addSql('DROP INDEX IDX_C5D7CC4FA76ED395 ON mentoring_contract_subscription');
        $this->addSql('DROP INDEX IDX_C5D7CC4F5E76FEF9 ON mentoring_contract_subscription');
        $this->addSql('ALTER TABLE mentoring_contract_subscription DROP user_id, DROP mentoring_contract_id');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

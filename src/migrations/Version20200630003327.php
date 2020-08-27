<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200630003327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, data LONGBLOB NOT NULL, content_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `group` ADD profile_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC044C5292E8AE2 ON `group` (profile_picture_id)');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role enum(\'member\', \'moderator\', \'administrator\')');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status enum(\'approved\', \'cancelled\', \'pending\', \'rejected\')');
        $this->addSql('ALTER TABLE skill ADD picture_id INT DEFAULT NULL, DROP icon');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E3DE477EE45BDBF ON skill (picture_id)');
        $this->addSql('ALTER TABLE user ADD profile_picture_id INT DEFAULT NULL, CHANGE gender gender enum(\'male\', \'female\')');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649292E8AE2 ON user (profile_picture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5292E8AE2');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477EE45BDBF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649292E8AE2');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP INDEX UNIQ_6DC044C5292E8AE2 ON `group`');
        $this->addSql('ALTER TABLE `group` DROP profile_picture_id');
        $this->addSql('ALTER TABLE group_assignment CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_contract_request CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_5E3DE477EE45BDBF ON skill');
        $this->addSql('ALTER TABLE skill ADD icon LONGBLOB NOT NULL, DROP picture_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649292E8AE2 ON user');
        $this->addSql('ALTER TABLE user DROP profile_picture_id, CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200621155340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE frequency_preferences (id INT AUTO_INCREMENT NOT NULL, mentoring_preferences_id INT NOT NULL, is_once_aweek TINYINT(1) NOT NULL, is_twice_aweek TINYINT(1) NOT NULL, is_every_day TINYINT(1) NOT NULL, is_twice_amonth TINYINT(1) NOT NULL, is_once_amonth TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_DFEB91FDAF85F8CF (mentoring_preferences_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE frequency_preferences ADD CONSTRAINT FK_DFEB91FDAF85F8CF FOREIGN KEY (mentoring_preferences_id) REFERENCES mentoring_preferences (id)');
        $this->addSql('ALTER TABLE user CHANGE gender gender enum(\'male\', \'female\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE frequency_preferences');
        $this->addSql('ALTER TABLE user CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

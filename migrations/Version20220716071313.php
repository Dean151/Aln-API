<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716071313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created table for feeders';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aln_feeder (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(16) NOT NULL, name VARCHAR(255) NOT NULL, last_seen DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', default_meal_amount SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE aln_feeder');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414155349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entity_demo ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE entity_demo ADD CONSTRAINT FK_9E8E668B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_9E8E668B12469DE2 ON entity_demo (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entity_demo DROP FOREIGN KEY FK_9E8E668B12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_9E8E668B12469DE2 ON entity_demo');
        $this->addSql('ALTER TABLE entity_demo DROP category_id');
    }
}

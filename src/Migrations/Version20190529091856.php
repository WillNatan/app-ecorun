<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529091856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE products_form (id INT AUTO_INCREMENT NOT NULL, devis_id INT DEFAULT NULL, products_list_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, height DOUBLE PRECISION NOT NULL, width DOUBLE PRECISION NOT NULL, qte INT NOT NULL, INDEX IDX_DE9F334541DEFADA (devis_id), INDEX IDX_DE9F3345E693ECD6 (products_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products_form ADD CONSTRAINT FK_DE9F334541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE products_form ADD CONSTRAINT FK_DE9F3345E693ECD6 FOREIGN KEY (products_list_id) REFERENCES products_form (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products_form DROP FOREIGN KEY FK_DE9F3345E693ECD6');
        $this->addSql('DROP TABLE products_form');
    }
}

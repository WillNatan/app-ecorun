<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531074524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attributes_product_form (attributes_id INT NOT NULL, product_form_id INT NOT NULL, INDEX IDX_C7260FD7BAAF4009 (attributes_id), INDEX IDX_C7260FD78E2F80CD (product_form_id), PRIMARY KEY(attributes_id, product_form_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributes_product_form ADD CONSTRAINT FK_C7260FD7BAAF4009 FOREIGN KEY (attributes_id) REFERENCES attributes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attributes_product_form ADD CONSTRAINT FK_C7260FD78E2F80CD FOREIGN KEY (product_form_id) REFERENCES product_form (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attributes DROP FOREIGN KEY FK_319B9E704584665A');
        $this->addSql('DROP INDEX IDX_319B9E704584665A ON attributes');
        $this->addSql('ALTER TABLE attributes DROP product_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attributes_product_form');
        $this->addSql('ALTER TABLE attributes ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attributes ADD CONSTRAINT FK_319B9E704584665A FOREIGN KEY (product_id) REFERENCES product_form (id)');
        $this->addSql('CREATE INDEX IDX_319B9E704584665A ON attributes (product_id)');
    }
}

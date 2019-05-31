<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531073931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attributes ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attributes ADD CONSTRAINT FK_319B9E704584665A FOREIGN KEY (product_id) REFERENCES product_form (id)');
        $this->addSql('CREATE INDEX IDX_319B9E704584665A ON attributes (product_id)');
        $this->addSql('ALTER TABLE product_form DROP FOREIGN KEY FK_DF60DFEEBAAF4009');
        $this->addSql('DROP INDEX IDX_DF60DFEEBAAF4009 ON product_form');
        $this->addSql('ALTER TABLE product_form DROP attributes_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attributes DROP FOREIGN KEY FK_319B9E704584665A');
        $this->addSql('DROP INDEX IDX_319B9E704584665A ON attributes');
        $this->addSql('ALTER TABLE attributes DROP product_id');
        $this->addSql('ALTER TABLE product_form ADD attributes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_form ADD CONSTRAINT FK_DF60DFEEBAAF4009 FOREIGN KEY (attributes_id) REFERENCES attributes (id)');
        $this->addSql('CREATE INDEX IDX_DF60DFEEBAAF4009 ON product_form (attributes_id)');
    }
}

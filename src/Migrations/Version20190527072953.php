<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527072953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A3D3D2749');
        $this->addSql('DROP INDEX IDX_B3BA5A5A3D3D2749 ON products');
        $this->addSql('ALTER TABLE products ADD parent_id INT NOT NULL, DROP children_id');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A727ACA70 FOREIGN KEY (parent_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A727ACA70 ON products (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A727ACA70');
        $this->addSql('DROP INDEX IDX_B3BA5A5A727ACA70 ON products');
        $this->addSql('ALTER TABLE products ADD children_id INT DEFAULT NULL, DROP parent_id');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A3D3D2749 FOREIGN KEY (children_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A3D3D2749 ON products (children_id)');
    }
}

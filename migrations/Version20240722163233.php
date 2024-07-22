<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722163233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD type_product_id INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A5887B07F FOREIGN KEY (type_product_id) REFERENCES type_product (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A5887B07F ON products (type_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A5887B07F');
        $this->addSql('DROP INDEX IDX_B3BA5A5A5887B07F ON products');
        $this->addSql('ALTER TABLE products DROP type_product_id');
    }
}

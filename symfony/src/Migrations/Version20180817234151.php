<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180817234151 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shopping_list_shopping_list_item DROP FOREIGN KEY FK_FC524471CAF1D95');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_list_product (shopping_list_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_DD8A4B6623245BF9 (shopping_list_id), INDEX IDX_DD8A4B664584665A (product_id), PRIMARY KEY(shopping_list_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_list_product ADD CONSTRAINT FK_DD8A4B6623245BF9 FOREIGN KEY (shopping_list_id) REFERENCES shopping_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_list_product ADD CONSTRAINT FK_DD8A4B664584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE shopping_list_item');
        $this->addSql('DROP TABLE shopping_list_shopping_list_item');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shopping_list_product DROP FOREIGN KEY FK_DD8A4B664584665A');
        $this->addSql('CREATE TABLE shopping_list_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_list_shopping_list_item (shopping_list_id INT NOT NULL, shopping_list_item_id INT NOT NULL, INDEX IDX_FC5244723245BF9 (shopping_list_id), INDEX IDX_FC524471CAF1D95 (shopping_list_item_id), PRIMARY KEY(shopping_list_id, shopping_list_item_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_list_shopping_list_item ADD CONSTRAINT FK_FC524471CAF1D95 FOREIGN KEY (shopping_list_item_id) REFERENCES shopping_list_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_list_shopping_list_item ADD CONSTRAINT FK_FC5244723245BF9 FOREIGN KEY (shopping_list_id) REFERENCES shopping_list (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE shopping_list_product');
    }
}

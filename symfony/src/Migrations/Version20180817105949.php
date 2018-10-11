<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180817105949 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shopping_list_shopping_list_item (shopping_list_id INT NOT NULL, shopping_list_item_id INT NOT NULL, INDEX IDX_FC5244723245BF9 (shopping_list_id), INDEX IDX_FC524471CAF1D95 (shopping_list_item_id), PRIMARY KEY(shopping_list_id, shopping_list_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_list_shopping_list_item ADD CONSTRAINT FK_FC5244723245BF9 FOREIGN KEY (shopping_list_id) REFERENCES shopping_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_list_shopping_list_item ADD CONSTRAINT FK_FC524471CAF1D95 FOREIGN KEY (shopping_list_item_id) REFERENCES shopping_list_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shopping_list_shopping_list_item');
    }
}

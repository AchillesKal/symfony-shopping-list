<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180812070702 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shopping_list ADD owner INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shopping_list ADD CONSTRAINT FK_3DC1A459CF60E67C FOREIGN KEY (owner) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_3DC1A459CF60E67C ON shopping_list (owner)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shopping_list DROP FOREIGN KEY FK_3DC1A459CF60E67C');
        $this->addSql('DROP INDEX IDX_3DC1A459CF60E67C ON shopping_list');
        $this->addSql('ALTER TABLE shopping_list DROP owner');
    }
}

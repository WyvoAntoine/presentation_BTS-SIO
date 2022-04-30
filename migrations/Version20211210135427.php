<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210135427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66A15BDBC');
        $this->addSql('DROP INDEX IDX_5E90F6D66A15BDBC ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE lebac_id le_bac_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D64035E5FC FOREIGN KEY (le_bac_id) REFERENCES bac (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D64035E5FC ON inscription (le_bac_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D64035E5FC');
        $this->addSql('DROP INDEX IDX_5E90F6D64035E5FC ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE le_bac_id lebac_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66A15BDBC FOREIGN KEY (lebac_id) REFERENCES bac (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D66A15BDBC ON inscription (lebac_id)');
    }
}

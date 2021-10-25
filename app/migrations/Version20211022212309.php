<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022212309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F47645AE1E2D10AE ON url (long_url)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F47645AE17D2FE0D ON url (short_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F47645AE1E2D10AE ON url');
        $this->addSql('DROP INDEX UNIQ_F47645AE17D2FE0D ON url');
    }
}

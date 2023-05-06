<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221106184319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add game entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE game (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD game_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_161498D3E48FD905 ON card (game_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3E48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP INDEX IDX_161498D3E48FD905 ON card');
        $this->addSql('ALTER TABLE card DROP game_id');
    }
}

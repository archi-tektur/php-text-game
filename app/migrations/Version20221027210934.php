<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221027210934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add card and answer tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE answer (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', source_card_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', target_card_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', text LONGTEXT NOT NULL, INDEX IDX_DADD4A253132248 (source_card_id), INDEX IDX_DADD4A2581A4234B (target_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A253132248 FOREIGN KEY (source_card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2581A4234B FOREIGN KEY (target_card_id) REFERENCES card (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A253132248');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2581A4234B');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE card');
    }
}

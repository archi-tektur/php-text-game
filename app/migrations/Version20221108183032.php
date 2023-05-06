<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221108183032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add boolean is card is first in the game';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE card ADD is_first_card TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE card DROP is_first_card');
    }
}

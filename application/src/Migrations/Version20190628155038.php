<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190628155038 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE players ADD uuid VARCHAR(255) NOT NULL AFTER name');
    }

    public function down(Schema $schema)
    {
    }
}
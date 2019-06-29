<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190628165947 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE games ADD status VARCHAR(255) NOT NULL AFTER name');
    }

    public function down(Schema $schema)
    {
    }
}

<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190629110853 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE players
          ADD class VARCHAR(255) DEFAULT NULL AFTER location,
          ADD picture VARCHAR(255) DEFAULT NULL AFTER name,
          CHANGE location location VARCHAR(255) DEFAULT NULL,
          CHANGE uuid uuid VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
    }
}

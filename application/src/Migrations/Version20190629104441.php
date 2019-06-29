<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190629104441 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE games DROP location, DROP level');
        $this->addSql('ALTER TABLE players ADD location VARCHAR(255) NOT NULL AFTER name, ADD level INT DEFAULT NULL AFTER location');
    }

    public function down(Schema $schema)
    {
    }
}

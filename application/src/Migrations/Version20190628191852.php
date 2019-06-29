<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190628191852 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE games ADD location VARCHAR(255) NOT NULL AFTER status');
        $this->addSql('ALTER TABLE games ADD level INT NULL DEFAULT NULL AFTER location');
    }

    public function down(Schema $schema)
    {
    }
}

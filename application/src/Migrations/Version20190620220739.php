<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190620220739 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql([
            'CREATE TABLE games (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL,
                UNIQUE INDEX name (name),
                PRIMARY KEY(id))
                DEFAULT CHARACTER SET utf8
                COLLATE utf8_unicode_ci
                ENGINE = InnoDB',
        ]);
    }

    public function down(Schema $schema)
    {
    }
}
<?php
namespace Main\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190620223501 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql([
            'CREATE TABLE players (
                id INT AUTO_INCREMENT NOT NULL,
                game_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                created_at DATETIME NOT NULL,
                INDEX IDX_264E43A6E48FD905 (game_id), 
                UNIQUE INDEX game_name (game_id, name), 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8 
                COLLATE utf8_unicode_ci
                ENGINE = InnoDB',
            'ALTER TABLE players ADD CONSTRAINT FK_264E43A6E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)',
        ]);
    }

    public function down(Schema $schema)
    {
    }
}

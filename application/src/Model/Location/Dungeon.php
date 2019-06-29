<?php
namespace Main\Model\Location;

use Main\Model\Location;

class Dungeon extends Location
{
    const IMAGE = 'https://i.pinimg.com/originals/59/6c/56/596c562fa1375be5ed08b61631b16c41.jpg';

    public function getAvailableLocations()
    {
        return [
            new Village($this->player),
        ];
    }
}
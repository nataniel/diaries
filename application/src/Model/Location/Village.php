<?php
namespace Main\Model\Location;

use Main\Model\Location;

class Village extends Location
{
    const IMAGE = 'https://cdna.artstation.com/p/assets/images/images/005/703/436/large/elwie-hi-mh222-1.jpg';

    public function getAvailableLocations()
    {
        return [
            new Armory($this->player),
            new Dungeon($this->player, 1),
        ];
    }
}
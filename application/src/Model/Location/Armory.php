<?php
namespace Main\Model\Location;

use Main\Model\Location;

class Armory extends Location
{
    const IMAGE = 'https://qph.fs.quoracdn.net/main-qimg-f6b5d9d00f347893bda7326d2c7a9a2b.webp';

    public function getAvailableLocations()
    {
        return [
            new Village($this->player),
        ];
    }
}
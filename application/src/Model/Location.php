<?php
namespace Main\Model;

abstract class Location
{
    const IMAGE = null;

    protected $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return Location[]
     */
    abstract public function getAvailableLocations();

    /**
     * @return string
     */
    public function getImage()
    {
        return static::IMAGE;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $class = get_called_class();
        return strtolower(preg_replace('/.*\\\\/', '', $class));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'game.location.' . $this->getName();
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return Player::findBy([
            'game' => $this->player->getGame(),
            'location' => $this->getName(),
        ]);
    }

    /**
     * @param  string $name
     * @param  Player $player
     * @return Location\Dungeon|Location\Village
     */
    public static function fromName($name, $player)
    {
        $locations = [
            'village' => Location\Village::class,
            'dungeon' => Location\Dungeon::class,
            'armory'  => Location\Armory::class,
        ];

        return new $locations[ $name ]($player);
    }
}
<?php
namespace Main\Model;

use E4u\Model\Entity;
use E4u\Model\Exception;

/**
 * @Entity
 * @Table(name="players", uniqueConstraints={
 *     @UniqueConstraint(name="game_name", columns={"game_id", "name"})
 * })
 */
class Player extends Entity
{
    /**
     * @var Game
     * @ManyToOne(targetEntity="Main\Model\Game", inversedBy="players")
     */
    protected $game;

    /** @Column(type="string") */
    protected $name;

    /** @Column(type="string", nullable=true) */
    protected $picture;

    /** @Column(type="string", nullable=true) */
    protected $location;

    /** @Column(type="string", nullable=true) */
    protected $class;

    /** @Column(type="integer", nullable=true) */
    protected $level;

    /** @Column(type="string", nullable=true) */
    protected $uuid;

    /** @Column(type="datetime") */
    protected $created_at;

    /** @var Location */
    protected $currentLocation;

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param  Game $game
     * @return bool
     */
    public function belongsTo($game)
    {
        return $this->game === $game;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param  Game $game
     * @return $this
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Location
     */
    public function getCurrentLocation()
    {
        if (null === $this->location) {
            return null;
        }

        if (null === $this->currentLocation) {
            $this->currentLocation = Location::fromName($this->location, $this);
        }

        return $this->currentLocation;
    }

    /**
     * @return Location[]
     */
    public function getAvailableLocations()
    {
        $location = $this->getCurrentLocation();
        return null !== $location
            ? $location->getAvailableLocations()
            : [];
    }

    /**
     * @param  string $location
     * @return $this
     */
    public function setLocation($location)
    {
        if (null === $this->location) {
            $this->setCurrentLocation($location);
            return $this;
        }

        $available = $this->getAvailableLocations();
        foreach ($available as $value) {
            if ($value->getName() == $location) {
                $this->setCurrentLocation($value);
                return $this;
            }
        }

        throw new Exception(sprintf('Invalid location: %s.', $location));
    }

    /**
     * @param  string|Location $location
     * @return $this
     */
    protected function setCurrentLocation($location)
    {
        if ($location instanceof Location) {

            $this->currentLocation = $location;
            $this->location = $location->getName();

        }
        else {

            $this->location = (string)$location;
            $this->currentLocation = null;

        }

        return $this;
    }

    /**
     * @return Player[]
     */
    public function getPlayersInMyLocation()
    {
        $location = $this->getCurrentLocation();
        if (null === $location) {
            return [];
        }

        $players = [];
        foreach ($location->getPlayers() as $player) {
            if ($player !== $this) {
                $players[] = $player;
            }
        }

        return $players;
    }

    /**
     * @param  string $file
     * @return $this
     */
    public function setPicture($file)
    {
        $this->picture = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
<?php
namespace Main\Model;

use E4u\Model\Entity;

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

    /** @Column(type="datetime") */
    protected $created_at;

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
}
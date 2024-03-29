<?php
namespace Main\Model;

use Doctrine\Common\Collections\ArrayCollection;
use E4u\Model\Entity;

/**
 * @Entity
 * @Table(name="games", uniqueConstraints={
 *     @UniqueConstraint(name="name", columns={"name"})
 * })
 */
class Game extends Entity
{
    const STATUS_PREPARATION = 'preparation';

    /** @Column(type="string") */
    protected $name;

    /** @Column(type="string") */
    protected $status = self::STATUS_PREPARATION;

    /** @Column(type="datetime") */
    protected $created_at;

    /**
     * @var Player[]|ArrayCollection
     * @OneToMany(targetEntity="Main\Model\Player", mappedBy="game", cascade={"all"}, orphanRemoval=true)
     **/
    protected $players;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        if (null === $this->name) {
            $this->generateName();
        }
    }

    /**
     * @param  int $length
     * @return $this
     */
    public function generateName($length = 6)
    {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $this->name = '';
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $this->name .= $alphabet[$n];
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  string $status
     * @return Game
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @param  string $name
     * @return Game|null
     */
    public static function findOneByName($name)
    {
        $qb = self::getEM()->createQueryBuilder();
        $qb->select('g')
            ->from(Game::class, 'g')
            ->where('g.name = ?1')
            ->setParameter(1, $name);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return string
     */
    public function showUrl()
    {
        return $this->actionUrl('show');
    }

    /**
     * @param  string $go
     * @return string
     */
    public function playUrl($go = null)
    {
        return $this->actionUrl('play') . (!empty($go) ? '&go=' . $go : '');
    }

    /**
     * @return string
     */
    public function joinUrl()
    {
        return $this->actionUrl('join');
    }

    /**
     * @param  string $action
     * @return string
     */
    public function actionUrl($action)
    {
        return sprintf('/games/%s?game=%s', $action, $this->name);
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
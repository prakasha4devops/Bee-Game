<?php

namespace AppBundle\Game\Model;

use Symfony\Component\Form\Exception\InvalidArgumentException;

/**
 * Abstract Class Bee.
 */
abstract class Bee implements BeeInterface
{
    /**
     * @var int
     */
    public static $IMPACT_BY_HIT = 0;

    /**
     * @var int
     */
    public static $TOTAL_HEALTH = 0;

    /**
     * @var int
     */
    protected $currentHealth;

    /**
     * @var string
     */
    protected $name;

    /**
     * Bee constructor.
     *
     * @param string $name
     *
     * @throws InvalidArgumentException
     */
    public function __construct($name)
    {
        if('' === $name || null === $name) {
            throw new InvalidArgumentException('Name cannot be empty or null.');
        }

        if(!is_string($name)) {
            throw new InvalidArgumentException('Name must be a string.');
        }

        $this->name          = $name;
        $this->currentHealth = static::$TOTAL_HEALTH;
    }

    /**
     * @return int
     */
    public function getCurrentHealth()
    {
        return (int) $this->currentHealth;
    }

    /**
     * @return bool
     */
    public function hit()
    {
        if (!$this->isKilled()) {
            $this->currentHealth = (int) max(0, $this->getCurrentHealth() - static::$IMPACT_BY_HIT);
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isKilled()
    {
        if (0 === $this->getCurrentHealth()) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}

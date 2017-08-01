<?php

namespace AppBundle\Game\Model;

/**
 * Worker Bee Class.
 */
class WorkerBee extends Bee
{
    /**
     * @var int
     */
    public static $IMPACT_BY_HIT = 10;

    /**
     * @var int
     */
    public static $TOTAL_HEALTH = 75;
}
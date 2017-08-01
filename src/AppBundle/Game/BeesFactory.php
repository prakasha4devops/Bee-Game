<?php

namespace AppBundle\Game;

use AppBundle\Game\Model\Bee;
use AppBundle\Game\Model\DroneBee;
use AppBundle\Game\Model\QueenBee;
use AppBundle\Game\Model\WorkerBee;

class BeesFactory
{
    /**
     * @var string
     */
    const QUEEN_BEE_NAME = 'Q';

    /**
     * @var string
     */
    const WORKER_BEE_NAME = 'W';

    /**
     * @var string
     */
    const DRONE_BEE_NAME = 'D';

    /**
     * @var array Bee[]
     */
    private $bees = [];

    /**
     * @param int $noOfQueenBees
     * @param int $noOfWorkerBees
     * @param int $noOfDroneBees
     *
     * @return array Bee[]
     */
    public function generateAllBees($noOfQueenBees, $noOfWorkerBees, $noOfDroneBees)
    {
        $this->bees = [];

        for ($i = 0; $i < $noOfQueenBees; $i++) {
            $this->bees[] = new QueenBee(self::QUEEN_BEE_NAME);
        }
        for ($i = 0; $i < $noOfWorkerBees; $i++) {
            $this->bees[] = new WorkerBee(self::WORKER_BEE_NAME);
        }
        for ($i = 0; $i < $noOfDroneBees; $i++) {
            $this->bees[] = new DroneBee(self::DRONE_BEE_NAME);
        }

        return $this->bees;
    }
}
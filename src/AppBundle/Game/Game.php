<?php

namespace AppBundle\Game;

use AppBundle\Game\Model\Bee;
use AppBundle\Game\Model\QueenBee;
use Symfony\Component\Config\Definition\Exception\Exception;

class Game
{
    /**
     * @var int
     */
    private $noOfQueenBees;

    /**
     * @var int
     */
    private $noOfWorkerBees;

    /**
     * @var int
     */
    private $noOfDroneBees;

    /**
     * @var array Bee[]
     */
    private $bees = [];

    /**
     * Game constructor.
     *
     * @param int $noOfQueenBees
     * @param int $noOfWorkerBees
     * @param int $noOfDroneBees
     */
    public function __construct($noOfQueenBees = 1, $noOfWorkerBees = 5, $noOfDroneBees = 8)
    {
        $this->noOfQueenBees  = (int) $noOfQueenBees;
        $this->noOfWorkerBees = (int) $noOfWorkerBees;
        $this->noOfDroneBees  = (int) $noOfDroneBees;

        $factory = new BeesFactory();
        $this->start($factory);
    }

    /**
     * @param BeesFactory $beesFactory
     */
    public function start(BeesFactory $beesFactory)
    {
        $this->bees = $beesFactory->generateAllBees($this->noOfQueenBees, $this->noOfWorkerBees, $this->noOfDroneBees);
    }

    /**
     * Reset Game.
     */
    public function reset(Beesfactory $beesFactory)
    {
        $this->start($beesFactory);
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return [serialize($this)];
    }

    /**
     * @return bool
     */
    public function isOver()
    {
        return $this->isWon();
    }

    /**
     * @return bool
     */
    public function isWon()
    {
        return 0 === $this->getBeesCount();
    }

    /**
     * @return int
     */
    public function getBeesCount()
    {
        return count($this->bees);
    }

    /**
     * @return Bee
     */
    public function hitABee()
    {
        $position = (int) rand(0, $this->getBeesCount() - 1);
        $bee      = $this->getBeeByPosition($position);

        $bee->hit();

        if ($bee->isKilled()) {
            if ($bee instanceof QueenBee) {
                $this->bees = [];
                return $bee;
            }

            unset($this->bees[$position]);
            $this->bees = array_values($this->bees);
        }

        return $bee;
    }

    /**
     * @return Bee
     *
     * @throws Exception
     */
    private function getBeeByPosition($position)
    {
        if (!isset($this->bees[$position])) {
            throw new Exception(sprintf('Unble to find random bee at position: %d', $position));
        }

        /** @var Bee $bee */
        return $this->bees[$position];
    }

    /**
     * @return int
     */
    public function getNoOfQueenBees()
    {
        return $this->noOfQueenBees;
    }

    /**
     * @return int
     */
    public function getNoOfWorkerBees()
    {
        return $this->noOfWorkerBees;
    }

    /**
     * @return int
     */
    public function getNoOfDroneBees()
    {
        return $this->noOfDroneBees;
    }

    /**
     * @return array
     */
    public function getBees()
    {
        return $this->bees;
    }
}

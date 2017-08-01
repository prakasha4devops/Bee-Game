<?php

namespace AppBundle\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Game Context Class.
 */
class GameContext implements GameContextInterface
{
    /**
     * @var string
     */
    const GAME_SESSION_GAME = 'beegame';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * GameContext constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session  = $session;
    }

    /**
     *
     * @return Game
     */
    public function newGame()
    {
        return new Game();
    }

    /**
     * @param Game $game
     */
    public function save(Game $game)
    {
        $this->session->set('beegame', $game->getContext());
    }

    /**
     * @return Game|bool
     */
    public function loadGame()
    {
        $data = $this->session->get('beegame');

        if (!isset($data[0])) {
            return false;
        }

        /** @var Game $game */
        $game = unserialize($data[0]);

        return $game;
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->session->set('beegame', array());
    }
}

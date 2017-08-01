<?php

namespace AppBundle\Game;

interface GameContextInterface
{
    /**
     * Resets the current game context
     *
     * @return void
     */
    public function reset();

    /**
     * Creates a new Game instance.
     *
     * @return Game
     */
    public function newGame();

    /**
     * Loads an existing game.
     *
     * @return Game
     */
    public function loadGame();

    /**
     * Saves the provided game.
     *
     * @param Game $game The game to save
     *
     * @return void
     */
    public function save(Game $game);
}
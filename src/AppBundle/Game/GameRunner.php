<?php

namespace AppBundle\Game;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Game Runner Class.
 */
class GameRunner
{
    /**
     * The Game context.
     *
     * @var GameContextInterface
     */
    private $context;

    /**
     * Constructor.
     *
     * @param GameContextInterface $context
     */
    public function __construct(GameContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * Loads the current game or creates a new one.
     *
     * @return Game
     */
    public function loadGame()
    {
        if ($this->context->loadGame() !== false) {
            return $this->context->loadGame();
        }

        $game = $this->context->newGame();
        $this->context->save($game);

        return $game;
    }

    /**
     * Tests the given letter against the current game.
     *
     * @return Game
     *
     * @throws NotFoundHttpException
     */
    public function hitABee()
    {
        if (!$game = $this->context->loadGame()) {
            throw $this->createNotFoundException('No game context set.');
        }

        $game->hitABee();
        $this->context->save($game);

        return $game;
    }

    public function resetGame(\Closure $onStatusCallback = null)
    {
        if (!$game = $this->context->loadGame()) {
            throw $this->createNotFoundException('No game context set.');
        }

        /** Custom logic on failure or on success, thanks to an anonymous function */
        if ($onStatusCallback) {
            call_user_func_array($onStatusCallback, [ $game ]);
        }

        $this->context->reset();

        return $game;
    }

    public function resetGameOnSuccess()
    {
        $onWonGame = function (Game $game) {
            if (!$game->isOver()) {
                throw $this->createNotFoundException('Current game is not yet over.');
            }

            if (!$game->isWon()) {
                throw $this->createNotFoundException('Current game must be won.');
            }
        };

        return $this->resetGame($onWonGame);
    }

    public function resetGameOnFailure()
    {
        $onLostGame = function (Game $game) {
            if (!$game->isOver()) {
                throw $this->createNotFoundException('Current game is not yet over.');
            }

            if (!$game->isHanged()) {
                throw $this->createNotFoundException('Current game must be lost.');
            }
        };

        return $this->resetGame($onLostGame);
    }

    private function createNotFoundException($message)
    {
        return new NotFoundHttpException($message);
    }
}

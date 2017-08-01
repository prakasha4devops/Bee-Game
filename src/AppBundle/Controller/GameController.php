<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class GameController extends Controller
{
    /**
     * This action displays the main board to play the game.
     *
     * @Route("", name="app_game_play")
     *
     * @Method("GET")
     */
    public function playAction(Request $request)
    {
        $game = $this->get('beegame.app.game_runner')->loadGame();

        return $this->render('game/board.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * This action displays the congratulations page.
     *
     * @Route("/win", name="app_game_win")
     *
     * @Method("GET")
     */
    public function winAction()
    {
        try {
            $game = $this->get('beegame.app.game_runner')->resetGameOnSuccess();
        } catch (\Exception $e) {
            return $this->redirectToRoute('app_game_play');
        }

        return $this->render('game/win.html.twig', ['game' => $game]);
    }

    /**
     * This action displays the losing page.
     *
     * @Route("/fail", name="app_game_fail")
     *
     * @Method("GET")
     */
    public function failAction()
    {
        try {
            $game = $this->get('beegame.app.game_runner')->resetGameOnFailure();
        } catch (\Exception $e) {
            return $this->redirectToRoute('app_game_play');
        }

        return $this->render('game/fail.html.twig', ['game' => $game]);
    }

    /**
     * This action resets the current game and starts a new one.
     *
     * @Route("/reset", name="app_game_reset")
     *
     * @Method("GET")
     */
    public function resetAction()
    {
        $this->get('beegame.app.game_runner')->resetGame();

        return $this->redirectToRoute('app_game_play');
    }

    /**
     * This action tries one single letter at a time.
     *
     * @Route("/hitABee/", name="app_game_hit_a_bee")
     *
     * @Method("GET")
     */
    public function hitABeeAction()
    {
        $game = $this->get('beegame.app.game_runner')->hitABee();

        if (!$game->isOver()) {
            return $this->redirectToRoute('app_game_play');
        }

        return $this->redirectToRoute($game->isWon() ? 'app_game_win' : 'app_game_fail');
    }
}

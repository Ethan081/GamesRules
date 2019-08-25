<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/games", name="games")
     */
    public function game(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();
        return $this->render('game/games.html.twig',
            [
                'games' => $games

            ]);
    }
    /**
     * @Route("/games/{id}", name="games_show")
     */
    public function show(GameRepository $gameRepository, $id)
    {
        $game = $gameRepository->find($id);
        return $this->render('game/show_single_game.html.twig',
            [
                'game' => $game
            ]);

    }
}

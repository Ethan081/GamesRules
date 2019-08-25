<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
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

    //    CRee un nouvelle article Game

    /**
     * @Route("/games/new", name="game_create")
     */
    public function create()
    {
        $form = $this->createForm(GameType::class);

        return $this->render('game/create_game.html.twig',
            [
                'gameForm' => $form->createView()
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

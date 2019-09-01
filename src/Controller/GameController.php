<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
                'games' => $games,

            ]);
    }

    /**
     * @Route("/games/search", name="games_search")
     */
    public function gameSearch(GameRepository $gameRepository, Request $request)
    {
        $word = $request->query->get('title');
        $gameTitle = $gameRepository->findByWord($word);
        return $this->render('game/games_search.html.twig',
            [
                'gameTitle'=> $gameTitle

            ]);
    }
//-----Je place la function show+wildcard toujours en dernier pour ne pas avoir de conflic--
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

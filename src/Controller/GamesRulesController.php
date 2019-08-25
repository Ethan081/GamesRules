<?php

namespace App\Controller;
use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GamesRulesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();
        return $this->render('games_rules/index.html.twig',
            [
                'games' => $games
        ]);
    }


}

<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


// ---------------------Cree un nouveux Game en DB-----------------

    /**
     * @Route("/games/new", name="game_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(GameType::class);
//        j 'instancie un l entite Game
        $game = new Game();

//       J assigne a $form la creation d'un formumaire et je lui lie mon instance de class Game($game)
        $form = $this->createForm(GameType::class, $game);

//        je recupere les donnee de mon formulaire et j annalise la requet .Si et seloemnt si la requet est de type Post
        $form->handleRequest($request);
        //dump($game); Je verifie si la requet est remplie de donnees.

        //Si le form et envoyer et valider
        if ($form->isSubmitted() && $form->isValid()) {
            //On envoie le game en DB grace a permit et flush
            $entityManager->persist($game);
            $entityManager->flush();
        // return a la page de tous les jeux.
            return $this->render('game/games.html.twig');
        }

        return $this->render('game/create_game.html.twig',
            [
                'gameForm' => $form->createView()
            ]);
    }

//------------------------------------------------

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

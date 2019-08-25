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
                'games' => $games

            ]);
    }


// ---------------------Cree et Edit un nouveux/anciens Game en DB-----------------
//Je cree deux routes l'une pour cree un article et l'autre pour les editees grace a leur id.
    /**
     * @Route("/games/new", name="game_create")
     * @Route("/games/{id}/edit", name="game_edit")
     */
    public function form(Game $game = null, Request $request, EntityManagerInterface $entityManager)
    {
//        Si c est un nouvelle article
//        j 'instancie un l entite Game
        if (!$game){
            $game = new Game();
        }

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
                'gameForm' => $form->createView(),
                'editMode' => $game->getId() !== null
            ]);
    }

//-----------------------------------------------------------
// ---------------------Supprimer Game en DB-----------------

    /**
     * @Route("/games/{id}/remove", name="game_remove")
     */

    public function remove(EntityManagerInterface $entityManager, $id, GameRepository $gameRepository)
    {
        $game = $gameRepository->find($id);

        $entityManager->remove($game);

        $entityManager->flush();

        return new Response('Le Jeux ' .$game->getTitle().' a bien ete supprime');
    }

//-----------------------------------------------------------

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

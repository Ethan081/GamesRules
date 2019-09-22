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

class AdminGameController extends AbstractController
{
    /**
     * @Route("/admin/game", name="admin_game")
     */
    public function index()
    {
        return $this->render('admin_game/index.html.twig', [
            'controller_name' => 'AdminGameController',
        ]);
    }

    // ---------------------Create & Edit Game en DB-----------------
//Je cree deux routes l'une pour cree un article et l'autre pour les editees grace a leur id.
    /**
     * @Route("/admin/games/new", name="game_create")
     * @Route("/admin/games/{id}/edit", name="game_edit")
     */
    public function form(Game $game = null, Request $request, EntityManagerInterface $entityManager)
    {
//        Si ce n'est pas un nouveau Game je l'edite sinon j'en cree un nouveau.
        if (!$game){
            $game = new Game();
        }
        //J'assigne a $form la creation d'un formumaire et je lui lie mon instance de class Game($game)
        $form = $this->createForm(GameType::class, $game);
        //Je demande au formulaire de gerer ma  request
        $form->handleRequest($request);

        //Je verifie si la requet est remplie de donnees.
//        dump($request);

        //Si le form et envoyer et valider
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$game->getId()){
                $game->setUpdatedAt(new \DateTime());
            }

            //J envoie et persiste en base de bonnee
            $entityManager->persist($game);
            $entityManager->flush();
            $this->addFlash('success', 'Enregistré avec Success' );
            //On recupere la valeur du fichier selectionner
//            return $this->redirectToRoute('games_show', ['id' => $game->getId()]);
            return $this->redirectToRoute('admin_page');

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
     * @Route("/admin/games/{id}/remove", name="game_remove")
     */

    public function remove(EntityManagerInterface $entityManager, $id, GameRepository $gameRepository)
    {
        $game = $gameRepository->find($id);

        $entityManager->remove($game);

        $entityManager->flush();
        $this->addFlash('success', 'Le Jeux ' .$game->getTitle().' a bien ete supprime' );

        return $this->redirectToRoute('admin_page');

    }

//-----------------------------------------------------------
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GamesRulesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('games_rules/index.html.twig',
            [

        ]);
    }

    /**
     * @Route("/games/12", name="games_show")
     */
    public function show(){
        return $this->render('games_rules/show.html.twig');
    }
}

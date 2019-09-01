<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_page")
     */
    public function admin(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();

        return $this->render('admin/admin.html.twig', [
            'games' => $games
        ]);
    }
}

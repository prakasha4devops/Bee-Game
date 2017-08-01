<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SidebarController extends Controller
{
    public function listLastGamesAction()
    {
        return $this->render('sidebar/games.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Utils\Area;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/left_menu/{pathInfo}", name="left_menu")
     */
    public function leftMenu(Area $area, string $pathInfo): Response
    {
        return $this->render('_left_menu.html.twig', [
            'area' => $area,
            'areaId' => \preg_match('/^\/candidato\/cda\/area\/(\d)$/', $pathInfo, $matches)  || \preg_match('/^\/seleccion\/cda\/area\/(\d)$/', $pathInfo, $matches) ?  $matches[1] : null
        ]);
    }
}

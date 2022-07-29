<?php

namespace App\Controller;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Services\CandidatoCda\Insaculacion;
use App\Utils\Area;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidato/cda")
 */
class CandidatoCdaController extends AbstractController
{
    /**
     * @Route("/", name="candidato_cda_index", methods={"GET"})
     */
    public function index(Area $area, CandidatoCdaRepository $candidatoCdaRepository): Response
    {
        $candidatos = [];
        foreach($area->getAll() as $key => $area){
            $candidatos[$area] = $candidatoCdaRepository->getByArea($key);
        }
 
        return $this->render('candidato_cda/index.html.twig', [
            'candidatos' => $candidatos,
            'area' => $area,
        ]);
    }

    /**
     * @Route("/area/{area}", name="candidato_cda_index_area", methods={"GET"})
     */
    public function indexArea(Area $areas, CandidatoCdaRepository $candidatoCdaRepository, int $area): Response
    {
        return $this->render('candidato_cda/index_area.html.twig', [
            'candidatosCda' => $candidatoCdaRepository->getByArea($area),
            'area' => $areas->getNombre($area),
        ]);
    }
    
    /**
     * @Route("/sorteo", name="candidato_cda_sorteo", methods={"GET"})
     */
    public function sorteo(Insaculacion $insaculacion): Response
    {
        // Se realiza la Insaculación 
        ($insaculacion)();

        return $this->redirectToRoute('seleccion_cda_index', [

        ], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/sorteo/{area}", name="candidato_cda_sorteo_area", methods={"GET"})
     */
    public function sorteoArea(Insaculacion $insaculacion, int $area): Response
    {
        // Se realiza la Insaculación 
        ($insaculacion)($area);

        return $this->redirectToRoute('seleccion_cda_index_area', [
            'area' => $area
        ], Response::HTTP_SEE_OTHER);
    }

}

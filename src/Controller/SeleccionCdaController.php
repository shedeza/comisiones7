<?php

namespace App\Controller;

use App\Repository\SeleccionCdaRepository;
use App\Utils\Area;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seleccion/cda")
 */
class SeleccionCdaController extends AbstractController
{
    /**
     * @Route("/", name="seleccion_cda_index", methods={"GET"})
     */
    public function index(Area $area, SeleccionCdaRepository $seleccionCdaRepository): Response
    {
        $seleccionadosCda = [];

        if(($count = $seleccionCdaRepository->countAll()) > 0){
            foreach(Area::AREAS as $key => $area){
                $seleccionadosCda[$area] = $seleccionCdaRepository->getByArea($key);
            }
        }

        return $this->render('seleccion_cda/index.html.twig', [
            'seleccionadosCda' => $seleccionadosCda,
            'areas' => Area::AREAS,
            'count' => $count,
        ]);
    }

    /**
     * @Route("/area/{area}", name="seleccion_cda_index_area", methods={"GET"})
     */
    public function indexArea(Area $areas, SeleccionCdaRepository $seleccionCdaRepository, int $area): Response
    {
        $titulos = [
            Area::CIENCIAS_BASICAS => '2 Suplentes',
            Area::INGENIERIA       => '1 Titular y 3 Suplentes',
            Area::CIENCIAS_BIOLOGICAS => '3 Titulares y 4 Suplentes',
            Area::CIENCIAS_DE_LA_SALUD => '1 suplente',
            Area::CIENCIAS_ECONOMICO_ADMINISTRATIVAS => '1 Suplente',
            Area::CIENCIAS_SOCIALES => '1 Suplente',
            Area::HUMANIDADES => '1 Titular y 4 Suplentes',
            Area::ANALISIS_Y_METODOS_DEL_DISENYO => '1 Titular y 3 Suplentes',
            Area::PRODUCCION_Y_CONTEXTO_DEL_DISENYO => '1 Suplente'
        ];

        $seleccionadosCda = [];

        $seleccionadosCda = $seleccionCdaRepository->getByArea($area);

        return $this->render('seleccion_cda/index_area.html.twig', [
            'seleccionadosCda' => $seleccionadosCda,
            'area' => ['id' => $area, 'nombre' => $areas->getNombre($area)],
            'titulos' => $titulos
        ]);
    }

    /**
     * @Route("/reset", name="seleccion_cda_reset")
     */
    public function reset(SeleccionCdaRepository $seleccionCdaRepository): Response
    {
        $seleccionCdaRepository->borraSeleccion();

        return $this->redirectToRoute('seleccion_cda_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/reset/{area}", name="seleccion_cda_reset_area")
     */
    public function resetArea(SeleccionCdaRepository $seleccionCdaRepository, $area): Response
    {
        $seleccionCdaRepository->borraSeleccion($area);

        return $this->redirectToRoute('seleccion_cda_index_area', ['area' => $area], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/download", name="seleccion_cda_download", methods={"GET"})
     */
    public function download(Area $area, SeleccionCdaRepository $seleccionCdaRepository): Response
    {
        
        $seleccionCda = $seleccionCdaRepository->getAll();

        $view = $this->render('seleccion_cda/index.csv.twig', [
            'seleccion_cdas' => $seleccionCda,
            'area' => $area,
        ]);        

        $fileName = 'seleccion_cda.csv';
        $response = new Response(iconv("UTF8", "WINDOWS-1252//IGNORE", $view));
        $response->headers->set('Content-Type', 'text/csv');

        $disposition = HeaderUtils::makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT, 
            $fileName
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

     /**
     * @Route("/download/{area}", name="seleccion_cda_download_area", methods={"GET"})
     */
    public function downloadArea(Area $areas, SeleccionCdaRepository $seleccionCdaRepository, int $area): Response
    {
        
        $seleccionCda = $seleccionCdaRepository->getByArea($area);

        $view = $this->render('seleccion_cda/index_area.csv.twig', [
            'seleccion_cdas' => $seleccionCda,
            'area' => $areas->getNombre($area),
        ]);        

        $fileName = iconv("UTF8", "ASCII//IGNORE//TRANSLIT", $areas->getNombre($area).'.csv');
        $response = new Response(iconv("UTF8", "WINDOWS-1252//IGNORE", $view));
        $response->headers->set('Content-Type', 'text/csv');

        $disposition = HeaderUtils::makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}

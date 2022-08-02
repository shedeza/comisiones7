<?php

namespace App\Controller;

use App\Entity\SeleccionCdr;
use App\Repository\SeleccionCdrActualRepository;
use App\Repository\SeleccionCdrRepository;
use App\Utils\Division;
use App\Utils\Unidad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seleccion/cdr")
 */
class SeleccionCdrController extends AbstractController
{
    /**
     * @Route("/", name="seleccion_cdr_index", methods={"GET"})
     */
    public function index(
        Unidad $unidad,
        Division $division,
        SeleccionCdrRepository $seleccionCdrRepository
    ): Response
    {
        return $this->render('seleccion_cdr/index.html.twig', [
            'seleccion_cdrs' => $seleccionCdrRepository->getAll(),
            'unidad' => $unidad,
            'division' => $division
        ]);
    }

    /**
     * @Route("/download", name="seleccion_cdr_download", methods={"GET"})
     */
    public function download(SeleccionCdrRepository $seleccionCdrRepository): Response
    {
        $unidad = [
            '001' => 'IZTAPALAPA',
            '002' => 'AZCAPOTZALCO',
            '005' => 'LERMA'
        ];

        $division = [
            '002' => 'CBI',
            '003' => 'CSH',
            '004' => 'CBS',
            '005' => 'CAD'
        ];
        $result = $this->render('seleccion_cdr/index.csv.twig', [
            'seleccion_cdrs' => $seleccionCdrRepository->gelAll(),
            'unidad' => $unidad,
            'division' => $division
        ]);

        $response = new Response();
        $filename = 'seleccion_cdr.csv';

        $response = new Response(iconv("UTF8", "WINDOWS-1252//IGNORE", $result));
        $response->headers->set('Content-Type', 'text/csv');

        $disposition = HeaderUtils::makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT, 
            $filename
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

    /**
     * @Route("/reset", name="seleccion_cdr_reset")
     */
    public function reset(SeleccionCdrRepository $seleccionCdrRepository): Response
    {
        $seleccionCdrRepository->borraSeleccion();

        return $this->redirectToRoute('seleccion_cdr_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{trimestre}/{empleado}", name="seleccion_cdr_show", methods={"GET"})
     */
    public function show($trimestre, $empleado, SeleccionCdrRepository $seleccionCdrRepository): Response
    {
        $seleccionCdr = $seleccionCdrRepository->findOneBy([
            'trimestre' => $trimestre,
            'empleado' => $empleado,
            ''
        ]);

        if (!$seleccionCdr) {
            throw $this->createNotFoundException('no se encontro el candidato');
        }

        return $this->render('seleccion_cdr/show.html.twig', [
            'seleccion_cdr' => $seleccionCdr,
        ]);
    }

    /**
     * @Route("/final", name="seleccion_cdr_final", methods={"GET"})
     */
    public function final(
        Unidad $unidad,
        Division $division,
        SeleccionCdrRepository $seleccionCdrRepository,
        SeleccionCdrActualRepository $seleccionCdrActualRepository
    ): Response
    {

        $actualT =  $seleccionCdrActualRepository->getByTipo('T');
        $seleccionT = $seleccionCdrRepository->getByTipo('T');
        $seleccionTit = array_merge($actualT, $seleccionT);

        usort($seleccionTit, function($a, $b) {
            if( $a['nombreUnidad'] != $b['nombreUnidad']){
                return $a['nombreUnidad'] > $b['nombreUnidad'];
            } else {
                return $a['nombreDivision'] > $b['nombreDivision'];
            }
        });

        $actualS =  $seleccionCdrActualRepository->getByTipo('S');
        $seleccionS = $seleccionCdrRepository->getByTipo('S');
        $seleccionSup = array_merge($actualS, $seleccionS);

        usort($seleccionSup, function($a, $b) {
            if( $a['nombreUnidad'] != $b['nombreUnidad']){
                return $a['nombreUnidad'] > $b['nombreUnidad'];
            } else {
                return $a['nombreDivision'] > $b['nombreDivision'];
            }
        });

        $seleccion = array_merge($seleccionTit, $seleccionSup);

        return $this->render('seleccion_cdr/final.html.twig', [
            'seleccion_cdrs' => $seleccion,
            'unidad' => $unidad,
            'division' => $division
        ]);
    }
}

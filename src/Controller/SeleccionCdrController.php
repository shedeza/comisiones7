<?php

namespace App\Controller;

use App\Entity\SeleccionCdr;
use App\Repository\SeleccionCdrRepository;
use App\Utils\Division;
use App\Utils\Unidad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            'seleccion_cdrs' => $seleccionCdrRepository->gelAll(),
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

        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'text/plain' );
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '";');
        $response->headers->set('Content-length',  strlen($result));
        $response->setCharset('UTF-8');

        // Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent($result);

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
}

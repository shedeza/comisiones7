<?php

namespace App\Controller;

use App\Entity\CandidatoCdr;
use App\Entity\SeleccionCdr;
use App\Repository\CandidatoCdrRepository;
use App\Services\CandidatoCdr\Insaculacion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidato/cdr")
 */
class CandidatoCdrController extends AbstractController
{
    /**
     * @Route("/", name="candidato_cdr_index", methods={"GET"})
     */ 
    public function index(CandidatoCdrRepository $candidatoCdrRepository): Response
    {
        return $this->render('candidato_cdr/index.html.twig', [
            'candidato_cdrs' => $candidatoCdrRepository->findBy([], [
                'claveUnidad' => 'ASC',
                'claveDivision' => 'ASC',
                'nomAux' => 'ASC'
            ]),
        ]);
    }


    /**
     * @Route("/{trimestre}/{empleado}", name="candidato_cdr_show", methods={"GET"})
     */
    public function show($trimestre, $empleado, CandidatoCdrRepository $candidatoCdrRepository): Response
    {
        $candidatoCdr = $candidatoCdrRepository->findOneBy([
            'trimestre' => $trimestre,
            'empleado' => $empleado
        ]);

        if (!$candidatoCdr) {
            throw $this->createNotFoundException('no se encontro el candidato');
        }

        return $this->render('candidato_cdr/show.html.twig', [
            'candidato_cdr' => $candidatoCdr,
        ]);
    }

    /**
     * @Route("/sorteo", name="candidato_cdr_sorteo", methods={"GET"})
     */
    public function sorteo(
        Insaculacion $insaculacion
    ){
        ($insaculacion)();      

        return $this->redirectToRoute('seleccion_cdr_index');
    }
   
}

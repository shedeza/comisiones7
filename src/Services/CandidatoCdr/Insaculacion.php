<?php

namespace App\Services\CandidatoCdr;

use App\Entity\CandidatoCdr;
use App\Repository\CandidatoCdrRepository;
use App\Repository\SeleccionCdrRepository;
use App\Utils\Division;
use App\Utils\Unidad;
use Doctrine\Common\Collections\ArrayCollection;

class Insaculacion {

    private $candidatoCdrRepository;
    
    public function __construct (
        CandidatoCdrRepository $candidatoCdrRepository,
        SeleccionCdrRepository $seleccionCdrRepository
    ) 
    {
        $this->candidatoCdrRepository = $candidatoCdrRepository;
        $this->seleccionCdrRepository = $seleccionCdrRepository;
    }

    public function __invoke (
       
    ) 
    {
        $this->candidatoCdrRepository->preparaSorteo();

        /**
         * CUAJIMALPA
         */

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::CUA,
            'claveDivision' => Division::CCD
        ]));
        $candidatoCdr->setTitularSuplente("T");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::CUA,
            'claveDivision' => Division::CCD
        ]));
        $candidatoCdr->setTitularSuplente("S");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::CUA,
            'claveDivision' => Division::CSH
        ]));
        $candidatoCdr->setTitularSuplente("T");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /**
         * Xochimilco
         */

        // CSH 

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CSH
        ]));
        $candidatoCdr->setTitularSuplente("T");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CSH
        ]));
        $candidatoCdr->setTitularSuplente("S");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        // CBS

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CBS
        ]));
        $candidatoCdr->setTitularSuplente("T");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CBS
        ]));
        $candidatoCdr->setTitularSuplente("S");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        // CAD 

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CAD
        ]));
        $candidatoCdr->setTitularSuplente("T");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        /** @var CandidatoCdr $candidatoCdr */
        $candidatoCdr = $this->candidatoCdrRepository->getCandidato(array_merge([
            'claveUnidad' => Unidad::XOC,
            'claveDivision' => Division::CAD
        ]));
        $candidatoCdr->setTitularSuplente("S");

        $this->candidatoCdrRepository->seleccionado($candidatoCdr);
        $this->seleccionCdrRepository->guardaSeleccion($candidatoCdr);

        

    }
}
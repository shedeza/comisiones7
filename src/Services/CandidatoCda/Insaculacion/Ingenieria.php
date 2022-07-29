<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class Ingenieria {
    private $candidatoCdaRepository;
    private $seleccionCdaRepository;

    public function __construct(
        CandidatoCdaRepository $candidatoCdaRepository, 
        SeleccionCdaRepository $seleccionCdaRepository
    )
    {
        $this->candidatoCdaRepository = $candidatoCdaRepository;
        $this->seleccionCdaRepository = $seleccionCdaRepository;

    }

    public function __invoke()
    {
      
        $parameters = [
            'claveComisionDictaminadora' => Area::INGENIERIA
        ];

        /** 
         * 1T I Computación
         */
        
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::IZT,
            'nombreDisciplina' => Disciplina::COMPUTACION
        ]));
       
        $candidatoCda->setTitularSuplente('T');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /**
         * 1S A Computación
         */

         /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::AZC,
            'nombreDisciplina' => Disciplina::COMPUTACION
        ]));
       
        $candidatoCda->setTitularSuplente('S');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /**
         * 2S I Ingeniería
         */

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::IZT,
            'nombreDisciplina' => Disciplina::INGENIERIA
        ]));
       
        $candidatoCda->setTitularSuplente('S');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::IZT,
        ]));
       
        $candidatoCda->setTitularSuplente('S');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

    }
}
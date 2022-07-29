<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasBasicas {

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
            'claveComisionDictaminadora' => Area::CIENCIAS_BASICAS
        ];

        /**
         * 1S A Física-Química
         */

        $disiplinas = [Disciplina::FISICA, Disciplina::QUIMICA];
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::AZC,
            'nombreDisciplina' => $disiplinas[rand(0,1)]
        ]));
        $candidatoCda->setTitularSuplente("S");

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /**
         * 1S I Matemáticas
         */

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::IZT,
            'nombreDisciplina' => Disciplina::MATEMATICAS
        ]));
        $candidatoCda->setTitularSuplente("S");
        
        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

    }
}
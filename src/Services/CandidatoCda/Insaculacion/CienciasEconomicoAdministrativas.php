<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasEconomicoAdministrativas {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_ECONOMICO_ADMINISTRATIVAS
        ];        

        /**
         * 1S A-I-X Administración-Economía
         */
        $disciplinas = [Disciplina::ADMINISTRACION, Disciplina::ECONOMIA];
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            //'claveUnidad' => Unidad::IZT,
            'nombreDisciplina' => $disciplinas[rand(0,1)]
        ]));
       
        $candidatoCda->setTitularSuplente('S');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);
    }
}
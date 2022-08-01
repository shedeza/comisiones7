<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class Humanidades {
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
            'claveComisionDictaminadora' => Area::HUMANIDADES
        ];        

        /**
         * 1T C Literatura
         */

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::CUA,
            //'nombreDisciplina' => Disciplina::LITERATURA
        ]));
       
        $candidatoCda->setTitularSuplente('T');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);


        /**
         * 1S X Comunicación-Psicología
         */

        $disciplinas = [Disciplina::CIENCIAS_DE_LA_COMUNICACION, Disciplina::PSICOLOGIA];
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::XOC,
            'nombreDisciplina' => $disciplinas[rand(0,1)],
        ]));

        $candidatoCda->setTitularSuplente('S');

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /**
         * 2S A-I Cualquier disciplina (que no se repitan)
         */
        $disciplinas = [];
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::AZC,
        ]));
       
        $candidatoCda->setTitularSuplente('S');
        $disciplinas[] = $candidatoCda->getDisciplina();

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => Unidad::IZT,
        ]), [], $disciplinas);
       
        $candidatoCda->setTitularSuplente('S');
        $disciplinas[] = $candidatoCda->getDisciplina();

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);


        $unidades = [Unidad::AZC, Unidad::IZT];
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' => $unidades[rand(0,1)]
        ]), [], $disciplinas);
       
        $candidatoCda->setTitularSuplente('S');
        $disciplina = $candidatoCda->getDisciplina();

        $this->candidatoCdaRepository->seleccionado($candidatoCda);
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda);
        

    }
}
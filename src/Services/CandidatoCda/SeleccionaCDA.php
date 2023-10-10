<?php

namespace App\Services\CandidatoCda;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;

class SeleccionaCDA 
{
    private CandidatoCdaRepository $candidatoCdaRepository;
    private SeleccionCdaRepository $seleccionCdaRepository;

    public function __construct(
        CandidatoCdaRepository $candidatoCdaRepository,
        SeleccionCdaRepository $seleccionCdaRepository
    )
    {
        $this->candidatoCdaRepository = $candidatoCdaRepository;
        $this->seleccionCdaRepository = $seleccionCdaRepository;
    }

    public function __invoke(array $parameters, $unidad, $disiplina, $titularSuplente, ?array $representa = null): CandidatoCda
    {
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato(array_merge($parameters, [
            'claveUnidad' =>$unidad,
            'nombreDisciplina' => $disiplina,
        ]));
        $candidatoCda->setTitularSuplente($titularSuplente);

        $this->candidatoCdaRepository->seleccionado($candidatoCda, $representa );
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda, $representa );

        return $candidatoCda;
    }
}
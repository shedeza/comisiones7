<?php

namespace App\Services\CandidatoCda;

use App\Entity\CandidatoCda;
use App\Repository\CandidatoCdaRepository;
use App\Repository\SeleccionCdaRepository;

class NewSeleccionaCDA 
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

    public function __invoke(
        array $parameters, 
        string $titularSuplente, 
        int $orden,
        array $unidades = [], 
        array $disiplinas = [], 
        ?array $representa = null
    ): ?CandidatoCda
    {    

        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato($parameters, $unidades, $disiplinas);

        if( $candidatoCda ) {
            $candidatoCda->setTitularSuplente($titularSuplente);

            $this->candidatoCdaRepository->seleccionado($candidatoCda, $representa );
            $this->seleccionCdaRepository->newGuardaSeleccion($candidatoCda, $orden, $representa );
        }

        return $candidatoCda;
    }
}
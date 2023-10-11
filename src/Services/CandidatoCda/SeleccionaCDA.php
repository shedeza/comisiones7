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

    public function __invoke(array $parameters, string $unidad, ?string $disiplina, string $titularSuplente, array $unidades = [], array $disiplinas = [], ?array $representa = null): CandidatoCda
    {    
        if ($disiplina) {
            $param =  array_merge($parameters, [
                'claveUnidad' =>$unidad,
                'nombreDisciplina' => $disiplina,
            ]);
        } else {
            $param =  array_merge($parameters, [
                'claveUnidad' =>$unidad,
            ]);
        }
        /** @var CandidatoCda $candidatoCda */
        $candidatoCda = $this->candidatoCdaRepository->getCandidato($param, $unidades, $disiplinas);
        $candidatoCda->setTitularSuplente($titularSuplente);

        $this->candidatoCdaRepository->seleccionado($candidatoCda, $representa );
        $this->seleccionCdaRepository->guardaSeleccion($candidatoCda, $representa );

        return $candidatoCda;
    }
}
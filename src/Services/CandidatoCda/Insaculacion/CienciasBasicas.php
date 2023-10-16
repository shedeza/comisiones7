<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasBasicas {

    private NewSeleccionaCDA $newSeleccionaCDA;

    public function __construct(
        NewSeleccionaCDA $newSeleccionaCDA
    )
    {
        $this->newSeleccionaCDA = $newSeleccionaCDA;
    }

    public function __invoke()
    {

        $parameters = [
            'claveComisionDictaminadora' => Area::CIENCIAS_BASICAS
        ];

        /**
         * AZC - 1 T Física,  1 S Física
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::FISICA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 1);

        ($this->newSeleccionaCDA)($param, 'S', 1);

        /**
         * AZC - 1 T Matemáticas, 1 S Matemáticas
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::MATEMATICAS,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 2);

        ($this->newSeleccionaCDA)($param, 'S', 2);

         /**
         * IZT - 1 T Física, 1 S Física 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::FISICA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 3);

        ($this->newSeleccionaCDA)($param, 'S', 3);

        /**
         * IZT - 1 T Matemáticas, 1 S Matemáticas
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::MATEMATICAS,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 4);

        ($this->newSeleccionaCDA)($param, 'S', 4);

        /**
         * CUA - 1 T C Química, 1 S IZT (CUA) Química
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::CUA,
            'nombreDisciplina' => Disciplina::QUIMICA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 5);

        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::QUIMICA,
        ]);
        ($this->newSeleccionaCDA)($param, 'S', 5, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA),
        ]);
       
        /**
         * 1T A (C) Física - Matemáticas
         */
        $disiplinas = [Disciplina::FISICA, Disciplina::MATEMATICAS];
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => $disiplinas[\rand(0,1)],
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA),
        ]);
        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA),
        ]);
    }
}
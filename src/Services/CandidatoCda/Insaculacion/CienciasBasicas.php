<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Division;
use App\Utils\Unidad;

class CienciasBasicas {

    private SeleccionaCDA $seleccionaCDA;

    public function __construct(
        SeleccionaCDA $seleccionaCDA
    )
    {
        $this->seleccionaCDA = $seleccionaCDA;
    }

    public function __invoke()
    {

        $parameters = [
            'claveComisionDictaminadora' => Area::CIENCIAS_BASICAS
        ];

        /**
         * 1T A Física
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::FISICA, 'T');

        /**
         * 1S A Física
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::FISICA, 'S');

        /**
         * 1T A Matemáticas
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::MATEMATICAS, 'T');

        /**
         * 1S A Matemáticas
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::MATEMATICAS, 'S');

         /**
         * 1T I Física
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::FISICA, 'T');

         /**
         * 1S I Física
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::FISICA, 'S');

        /**
         * 1T I Matemáticas
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::MATEMATICAS, 'T');

        /**
         * 1S I Matemáticas
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::MATEMATICAS, 'S');


        /**
         * 1T C Química
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, Disciplina::QUIMICA, 'T');

        /**
         * 1S I (C) Química
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::QUIMICA, 'S', [
            'unidad' => Unidad::getUnidad(Unidad::CUA),
        ]);
       
        /**
         * 1T A (C) Física - Matemáticas
         */
        $disiplinas = [Disciplina::FISICA, Disciplina::MATEMATICAS];
        $disiplina = $disiplinas[\rand(0,1)];
        ($this->seleccionaCDA)($parameters, Unidad::AZC, $disiplina, 'T', [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

        /**
         * 1S A (C) Física - Matemáticas
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, $disiplina, 'S', [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);
    }
}
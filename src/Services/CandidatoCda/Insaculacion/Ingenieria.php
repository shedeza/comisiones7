<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class Ingenieria {
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
            'claveComisionDictaminadora' => Area::INGENIERIA
        ];

        /**
         * 1T A Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::INGENIERIA, 'T');

        /**
         * 1S A Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::INGENIERIA, 'S');

        /**
         * 1T A Computación
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::COMPUTACION, 'T');

        /**
         * 1T A Computación
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::COMPUTACION, 'S');

        /**
         * 1T I Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::INGENIERIA, 'T');

        /**
         * 1S I Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::INGENIERIA, 'S');

        /**
         * 1T A Biomédica
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::BIOMEDICA, 'T');

        /**
         * 1T A Biomédica
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::BIOMEDICA, 'S');

        /**
         * 1T L Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::LER, Disciplina::INGENIERIA, 'T');

        /**
         * 1T L (A) Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::INGENIERIA, 'S', [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);

        /**
         * 1T C (A) Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::INGENIERIA, 'T', [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

        /**
         * 1T C (I) Ingeniería
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::INGENIERIA, 'T', [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

    }
}
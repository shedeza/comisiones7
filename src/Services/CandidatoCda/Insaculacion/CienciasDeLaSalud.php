<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasDeLaSalud {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_DE_LA_SALUD
        ];   
        
        /**
         * 1T I Medicina
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::MEDICINA, 'T');

        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::MEDICINA, 'S');

        /**
         * 1T I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT,  Disciplina::CIENCIAS_BIOMEDICAS, 'T');
        
        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT,Disciplina::CIENCIAS_BIOMEDICAS, 'S');

        /**
         * 1T X Nutrición
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::NUTRICION, 'T');

        /**
         * 1S X Nutrición
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::NUTRICION, 'S');

        /**
         * 1T X Medicina
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::MEDICINA, 'T');

        /**
         * 1S X Medicina
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::MEDICINA, 'S');

        /**
         * 1T X  
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], [Disciplina::ENFERMERIA, Disciplina::PSICOLOGIA]);

        /**
         * 1S X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], [Disciplina::MEDICINA, Disciplina::NUTRICION], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);

        /**
         * 1T S 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'S', [], [Disciplina::MEDICINA, Disciplina::NUTRICION], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);


    }
}
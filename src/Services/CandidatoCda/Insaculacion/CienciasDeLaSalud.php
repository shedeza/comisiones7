<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasDeLaSalud {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_DE_LA_SALUD
        ];   

        /**
         * IZT - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 1, [], [Disciplina::ENFERMERIA]);

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 1);

        /**
         * IZT - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 2, [], [Disciplina::ENFERMERIA, $seleccionaCDA->getDisciplina()]);

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 2);

        /**
         * XOC - 1 T Nutrición, 1 S Nutrición
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
            'nombreDisciplina' => Disciplina::NUTRICION,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 3);

        ($this->newSeleccionaCDA)($param, 'S', 3);

        /**
         * XOC - 1 T Medicina, 1 S Medicina
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
            'nombreDisciplina' => Disciplina::MEDICINA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 4);

        ($this->newSeleccionaCDA)($param, 'S', 4);

        /**
         * XOC - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 5, [], [Disciplina::ENFERMERIA, Disciplina::PSICOLOGIA, Disciplina::MEDICINA, Disciplina::CIENCIAS_BIOMEDICAS]);
        /**
         * 1S X 
         */
        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 5);



        /**
         * XOC (LER) - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $seleccionaCDA =  ($this->newSeleccionaCDA)($param, 'T', 6, [], [$seleccionaCDA->getDisciplina(), Disciplina::ENFERMERIA, Disciplina::PSICOLOGIA, Disciplina::MEDICINA, Disciplina::CIENCIAS_BIOMEDICAS], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);


    }
}
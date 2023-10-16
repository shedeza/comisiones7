<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class Ingenieria {
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
            'claveComisionDictaminadora' => Area::INGENIERIA
        ];

        /**
         * AZC - 1 T Ingeniería, 1 S Ingeniería
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::INGENIERIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 1);

        ($this->newSeleccionaCDA)($param, 'S', 1);

        /**
         * AZC - 1 T Computación, 1 S Computación
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::COMPUTACION,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 2);

        ($this->newSeleccionaCDA)($param, 'S', 2);

        /**
         * IZT - 1 T Ingeniería, 1 S Ingeniería
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::INGENIERIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 3);

        ($this->newSeleccionaCDA)($param, 'S', 3);
       
        /**
         * IZT - 1 T Biomédica, 1 S Biomédica
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::CIENCIAS_BIOMEDICAS,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 4);

        ($this->newSeleccionaCDA)($param, 'S', 4);


        /**
         * LER - 1 T Ingeniería, AZC (LER) - 1 S Ingeniería
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::LER,
            'nombreDisciplina' => Disciplina::INGENIERIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 5);

        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::INGENIERIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'S', 5, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);


        /**
         * AZC - (CUA) 1 Ingeniería, (CUA) 1 S Ingeniería
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::INGENIERIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

    }
}
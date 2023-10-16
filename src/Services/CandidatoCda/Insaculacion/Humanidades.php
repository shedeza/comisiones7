<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class Humanidades {
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
            'claveComisionDictaminadora' => Area::HUMANIDADES
        ];        

        $disciplinas = [Disciplina::CIENCIAS_DE_LA_COMUNICACION];

        /**
         * CUA - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::CUA,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 5, [], \array_merge($disciplinas, [Disciplina::ARTES, Disciplina::HISTORIA, Disciplina::LITERATURA ]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 5);

        /**
         * IZT - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 2, [], \array_merge($disciplinas, [Disciplina::LITERATURA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 2);

        /**
         * IZT - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 3, [], \array_merge($disciplinas, [Disciplina::LITERATURA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 3);


        /**
         * AZC - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 1, [], \array_merge($disciplinas, [Disciplina::EDUCACION, Disciplina::LINGUISTICA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 1);

        /**
         * XOC - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 4, [],  [Disciplina::FILOSOFIA]);
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 4); 

        /**
         * XOC (LER) - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 6, [], [$seleccionaCDA->getDisciplina(), Disciplina::FILOSOFIA], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
        $disciplinas[] = $seleccionaCDA->getDisciplina();

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
    }
}
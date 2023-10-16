<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasEconomicoAdministrativas {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_ECONOMICO_ADMINISTRATIVAS
        ];        

        $disciplinas = [];
        $countAdministracion = 0;

        /**
         * AZC - 1 T,  1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 1, [], [Disciplina::FINANZAS]);
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
        }   

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 1);

        /**
         * AZC - 1 T,  1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 2, [], array_merge($disciplinas, [$seleccionaCDA->getDisciplina(), Disciplina::FINANZAS]));
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 2);


        /**
         * IZT - 1 T,  1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 3);

        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 3);

        /**
         * IZT - 1 T,  1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 4, [],  array_merge($disciplinas, [$seleccionaCDA->getDisciplina()]));
        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 4);

        /**
         * XOC - 1 T, 1 S
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
            'nombreDisciplina' => Disciplina::ECONOMIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 5);

        ($this->newSeleccionaCDA)($param, 'S', 5);

        /**
         * CUA - 1 T, AZC (CUA) - 1 S
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::CUA,
            'nombreDisciplina' => Disciplina::ADMINISTRACION,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 6);

        $param['claveUnidad'] =  Unidad::AZC;
        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);
    }
}
<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasEconomicoAdministrativas {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_ECONOMICO_ADMINISTRATIVAS
        ];        

        $disciplinas = [];
        $countAdministracion = 0;
        $countEconomia = 0;

        /**
         * 1T A 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'T', [], [Disciplina::FINANZAS]);
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
        }


        /**
         * 1S A 
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T A 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'T', [], array_merge($disciplinas, [$seleccionaCDA->getDisciplina(), Disciplina::FINANZAS]));
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }


        /**
         * 1S A 
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, $seleccionaCDA->getDisciplina(), 'S');


        /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T');
        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }

        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

         /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [],  array_merge($disciplinas, [$seleccionaCDA->getDisciplina()]));
        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }

        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::ECONOMIA, 'T');

        /**
         * 1S X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, $seleccionaCDA->getDisciplina(), 'S');
        
         /**
         * 1T C 
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, Disciplina::ECONOMIA, 'T');

        /**
         * 1S X (C) 
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::ECONOMIA, 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);
    }
}
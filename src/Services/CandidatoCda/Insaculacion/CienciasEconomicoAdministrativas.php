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

        /**
         * 1T A 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'T', [], [Disciplina::FINANZAS]);
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }

        /**
         * 1S A 
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [], $disciplinas);
        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }

        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

         /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [], $disciplinas);
        if ($seleccionaCDA->getDisciplina() == Disciplina::FINANZAS) {
            $disciplinas[] = Disciplina::FINANZAS;
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ADMINISTRACION) {
            $countAdministracion++;
            if ($countAdministracion > 2) {
                $disciplinas[] = Disciplina::ADMINISTRACION;
            }
        }
        if ($seleccionaCDA->getDisciplina() == Disciplina::ECONOMIA) {
            $disciplinas[] = Disciplina::ECONOMIA;
        }

        /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::ECONOMIA, 'T');

        /**
         * 1S X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::ECONOMIA, 'S');
        
         /**
         * 1T C 
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, Disciplina::ECONOMIA, 'T');

        /**
         * 1S X (C) 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::ECONOMIA, 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);
    }
}
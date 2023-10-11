<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class Humanidades {
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
            'claveComisionDictaminadora' => Area::HUMANIDADES
        ];        

        $disciplinas = [Disciplina::CIENCIAS_DE_LA_COMUNICACION];

        /**
         * 1T C
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::CUA, null, 'T', [], \array_merge($disciplinas, [Disciplina::ARTES, Disciplina::HISTORIA, Disciplina::LITERATURA ]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S C 
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [], \array_merge($disciplinas, [Disciplina::LITERATURA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S I 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [], \array_merge($disciplinas, [Disciplina::LITERATURA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S I 
         */
       ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T A 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'T', [],  \array_merge($disciplinas, [Disciplina::EDUCACION, Disciplina::LINGUISTICA]));
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S A 
         */
       ($this->seleccionaCDA)($parameters, Unidad::AZC, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], [Disciplina::FILOSOFIA]);
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X (L)
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], [$seleccionaCDA->getDisciplina(), Disciplina::FILOSOFIA], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
        $disciplinas[] = $seleccionaCDA->getDisciplina();

         /**
         * 1S X (L)
         */
       ($this->seleccionaCDA)($parameters, Unidad::XOC, $seleccionaCDA->getDisciplina(), 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
    }
}
<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasSociales {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_SOCIALES
        ];        

        $disciplinas = [];
        $countSocilogia = 0;

        /**
         * 1T A Sociología
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::SOCIOLOGIA, 'T');

        /**
         * 1S A Sociología
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, Disciplina::SOCIOLOGIA, 'S');

        /**
         * 1T I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T');
        if($seleccionaCDA->getDisciplina() == Disciplina::POLITICA) {
            $disciplinas[] = Disciplina::POLITICA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::ANTROPOLOGIA) {
            $disciplinas[] = Disciplina::ANTROPOLOGIA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::PSICOLOGIA) {
            $disciplinas[] = Disciplina::PSICOLOGIA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::SOCIOLOGIA) {
           $countSocilogia++;
        } 

        /**
         * 1S I 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, $seleccionaCDA->getDisciplina(), 'S');

        /**
         * 1T X Política
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::POLITICA, 'T');

        /**
         * 1S X Política 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::POLITICA, 'S'); 

        /**
         * 1T X 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], array_merge($disciplinas, [Disciplina::POLITICA]));
        if($seleccionaCDA->getDisciplina() == Disciplina::POLITICA) {
            $disciplinas[] = Disciplina::POLITICA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::ANTROPOLOGIA) {
            $disciplinas[] = Disciplina::ANTROPOLOGIA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::PSICOLOGIA) {
            $disciplinas[] = Disciplina::PSICOLOGIA;
        } 

        if($seleccionaCDA->getDisciplina() == Disciplina::SOCIOLOGIA) {
            $countSocilogia++;

            if($countSocilogia > 1) {
                $disciplinas[] = Disciplina::PSICOLOGIA;
            }
        }  

        /**
         * 1S X  
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, $seleccionaCDA->getDisciplina(), 'S'); 

        /**
         * 1T C 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::CUA, null, 'T', [], $disciplinas);

        /**
         * 1S C  
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, $seleccionaCDA->getDisciplina(), 'S'); 
        

        /**
         * 1T L 
         */
        $seleccionaCDA = ($this->seleccionaCDA)($parameters, Unidad::LER, Disciplina::POLITICA, 'T', []);

        /**
         * 1S L  
         */
        ($this->seleccionaCDA)($parameters, Unidad::LER, $seleccionaCDA->getDisciplina(), 'S'); 
    }
}
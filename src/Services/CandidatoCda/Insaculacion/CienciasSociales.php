<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasSociales {
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
            'claveComisionDictaminadora' => Area::CIENCIAS_SOCIALES
        ];        

        $disciplinas = [];
        $countSocilogia = 0;

        /**
         * AZC - 1 T Sociología, 1 S Sociología
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::AZC,
            'nombreDisciplina' => Disciplina::SOCIOLOGIA
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 1);

        ($this->newSeleccionaCDA)($param, 'S', 1);


        /**
         * IZT - 1 T, 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 2);

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

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 2);

        /**
         * XOC - 1 T Política, 1 S Política
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
            'nombreDisciplina' => Disciplina::POLITICA
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 3);

        ($this->newSeleccionaCDA)($param, 'S', 3);

        /**
         * XOC - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 4, [], array_merge($disciplinas, [Disciplina::POLITICA]));

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
        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 4); 

        /**
         * XOC - 1 T , 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::CUA,
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 5, [], $disciplinas);

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 5); 
        
        /**
         * LER - 1 T, 1 S 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::LER,
            'nombreDisciplina' => Disciplina::POLITICA
        ]);
        $seleccionaCDA = ($this->newSeleccionaCDA)($param, 'T', 6);

        $param['nombreDisciplina'] = $seleccionaCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 6);
    }
}
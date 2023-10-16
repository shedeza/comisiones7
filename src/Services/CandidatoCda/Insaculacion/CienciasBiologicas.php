<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasBiologicas {

    private NewSeleccionaCDA $newSeleccionaCDA;

    public function __construct(
        NewSeleccionaCDA $newSeleccionaCDA
    )
    {
        $this->newSeleccionaCDA =  $newSeleccionaCDA;
    }

    public function __invoke()
    {
        $parameters = [
            'claveComisionDictaminadora' => Area::CIENCIAS_BIOLOGICAS
        ];        

        $disciplinas = [];
        $countMVZ = 0;
        $countQFB = 0;

        /**
         * IZT - 1 T Biología, 1 S Biología
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
            'nombreDisciplina' => Disciplina::BIOLOGIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 1);

        ($this->newSeleccionaCDA)($param, 'S', 1);


        /**
         * IZT - 1 T , 1 S (Disciplina igual al titular) 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $candidatoCDA = ($this->newSeleccionaCDA)($param, 'T', 2);
        if ($candidatoCDA->getDisciplina() == Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA) {
            $countMVZ++;
        } else if ($candidatoCDA->getDisciplina() == Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA) {
            $countQFB++;
        } else {
            $disciplinas[] = $candidatoCDA->getDisciplina();
        }
    
        $param['nombreDisciplina'] = $candidatoCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 2);


        /**
         * XOC - 1 T Biología, 1 S Biología
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
            'nombreDisciplina' => Disciplina::BIOLOGIA,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 3);

        ($this->newSeleccionaCDA)($param, 'S', 3);

        /**
         * XOC - 1 T , 1 S (Disciplina igual al titular) 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $candidatoCDA = ($this->newSeleccionaCDA)($param, 'T', 4, [], $disciplinas);
        if ($candidatoCDA->getDisciplina() == Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA) {
            $countMVZ++;
            if($countMVZ > 1) {
                $disciplinas[] = Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA;
            }
        } else if ($candidatoCDA->getDisciplina() == Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA) {
            $countQFB++;
            if($countQFB > 1) {
                $disciplinas[] = Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA;
            }
        } else {
            $disciplinas[] = $candidatoCDA->getDisciplina();
        }

        $param['nombreDisciplina'] = $candidatoCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 4);

        /**
         * CUA - 1 T  ING. BIOQUÍM. IND., XOC (CUA) - 1 S
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::CUA,
            'nombreDisciplina' => Disciplina::INGENIERIA_BIOQUIMICA_INDUSTRIAL,
        ]);
        ($this->newSeleccionaCDA)($param, 'T', 5);

        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::XOC,
        ]);
        $candidatoCDA = ($this->newSeleccionaCDA)($param, 'S', 5, [], $disciplinas, [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);
        if ($candidatoCDA->getDisciplina() == Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA) {
            $countMVZ++;
            if($countMVZ > 1) {
                $disciplinas[] = Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA;
            }
        } else if ($candidatoCDA->getDisciplina() == Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA) {
            $countQFB++;
            if($countQFB > 1) {
                $disciplinas[] = Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA;
            }
        } else {
            $disciplinas[] = $candidatoCDA->getDisciplina();
        }

        /**
         * IZT (LLER) - 1 T, 1 S (Disciplina igual al titular) 
         */
        $param =  array_merge($parameters, [
            'claveUnidad' =>  Unidad::IZT,
        ]);
        $candidatoCDA = ($this->newSeleccionaCDA)($param, 'T', 6, [], $disciplinas, [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);

        $param['nombreDisciplina'] = $candidatoCDA->getDisciplina();
        ($this->newSeleccionaCDA)($param, 'S', 6, [], $disciplinas, [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);



    }
}
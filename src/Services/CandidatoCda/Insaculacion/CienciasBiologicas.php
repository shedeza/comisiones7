<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Entity\CandidatoCda;
use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Disciplina;
use App\Utils\Unidad;

class CienciasBiologicas {

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
            'claveComisionDictaminadora' => Area::CIENCIAS_BIOLOGICAS
        ];        

        $disciplinas = [];
        $countMVZ = 0;
        $countQFB = 0;

        /**
         * 1T I Biología
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::BIOLOGIA, 'T');

        /**
         * 1S I Biología
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, Disciplina::BIOLOGIA, 'S');

        /**
         * 1T I 
         */
        /** @var CandidatoCda $candidatoCDA */
        $candidatoCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T');
        if ($candidatoCDA->getDisciplina() == Disciplina::MEDICINA_VETERINARIA_Y_ZOOTECNIA) {
            $countMVZ++;
        } else if ($candidatoCDA->getDisciplina() == Disciplina::QUIMICA_FARMACEUTICA_BIOLOGICA) {
            $countQFB++;
        } else {
            $disciplinas[] = $candidatoCDA->getDisciplina();
        }
    
        /**
         * 1S I 
         */
        /** @var CandidatoCda $candidatoCDA */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $candidatoCDA->getDisciplina(), 'S');

        /**
         * 1T X Biología
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::BIOLOGIA, 'T');

        /**
         * 1S X Biología
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, Disciplina::BIOLOGIA, 'S');

        /**
         * 1T X 
         */
        $candidatoCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T', [], $disciplinas);
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
         * 1S X 
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, $candidatoCDA->getDisciplina(), 'S');

        /**
         * 1T C ING. BIOQUÍM. IND.
         */
        ($this->seleccionaCDA)($parameters, Unidad::CUA, Disciplina::INGENIERIA_BIOQUIMICA_INDUSTRIAL, 'T');

        /**
         * 1S X (C) 
         */
        $candidatoCDA = ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'S', [], $disciplinas, [
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
         * 1T I (C) 
         */
        $candidatoCDA = ($this->seleccionaCDA)($parameters, Unidad::IZT, null, 'T', [], $disciplinas, [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
        $disciplinas[] = $candidatoCDA->getDisciplina();

        /**
         * 1T I (C) 
         */
        ($this->seleccionaCDA)($parameters, Unidad::IZT, $candidatoCDA->getDisciplina(), 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::LER)
        ]);
    }
}
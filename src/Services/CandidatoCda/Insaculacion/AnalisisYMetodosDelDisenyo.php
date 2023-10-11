<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Unidad;

class AnalisisYMetodosDelDisenyo {

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
            'claveComisionDictaminadora' => Area::ANALISIS_Y_METODOS_DEL_DISENYO
        ];        

        for($i =  0; $i < 3; $i++) {
            /**
             * 1T A 
             */
            ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'T');

            /**
             * 1S A 
             */
            ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'S');
        }

        for($i =  0; $i < 2; $i++) {
            /**
             * 1T X 
             */
            ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T');

            /**
             * 1S X 
             */
            ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'S');
        }

            /**
             * 1T X 
             */
            ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'T');

            /**
             * 1S A (X)
             */
            ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'S', [], [], [
                'unidad' => Unidad::getUnidad(Unidad::XOC)
            ]);
    }
}
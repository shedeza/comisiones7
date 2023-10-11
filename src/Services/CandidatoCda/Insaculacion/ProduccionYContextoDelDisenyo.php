<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\SeleccionaCDA;
use App\Utils\Area;
use App\Utils\Unidad;

class ProduccionYContextoDelDisenyo {

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
            'claveComisionDictaminadora' => Area::PRODUCCION_Y_CONTEXTO_DEL_DISENYO
        ];        

        for($i =  0; $i < 2; $i++) {
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

        for($i =  0; $i < 2; $i++) {
            /**
             * 1T C 
             */
            ($this->seleccionaCDA)($parameters, Unidad::CUA, null, 'T');
        }

        /**
         * 1S A (C)
         */
        ($this->seleccionaCDA)($parameters, Unidad::AZC, null, 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

        /**
         * 1S X (C)
         */
        ($this->seleccionaCDA)($parameters, Unidad::XOC, null, 'S', [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

    }
}
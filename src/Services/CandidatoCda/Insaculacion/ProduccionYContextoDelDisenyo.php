<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Unidad;

class ProduccionYContextoDelDisenyo {

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
            'claveComisionDictaminadora' => Area::PRODUCCION_Y_CONTEXTO_DEL_DISENYO
        ];        

        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::AZC
        ]);
        for($i =  1; $i < 3; $i++) {
           /**
             * AZC - 1 T, 1 S  
             */
            ($this->newSeleccionaCDA)($param, 'T', $i);

            ($this->newSeleccionaCDA)($param, 'S', $i);
        }

        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::XOC
        ]);
        for($i =  3; $i < 5; $i++) {
            /**
             * XOC - 1 T, 1 S  
             */
            ($this->newSeleccionaCDA)($param, 'T', $i);

            ($this->newSeleccionaCDA)($param, 'S', $i);
        }

        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::CUA
        ]);
        for($i =  5; $i < 7; $i++) {
            /**
             * 1T C 
             */
            ($this->newSeleccionaCDA)($param, 'T', $i);
        }

        /**
         * 1S A (C)
         */
        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::AZC
        ]);
        ($this->newSeleccionaCDA)($param, 'S', 5, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

        /**
         * 1S X (C)
         */
        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::XOC
        ]);
        ($this->newSeleccionaCDA)($param, 'S', 6, [], [], [
            'unidad' => Unidad::getUnidad(Unidad::CUA)
        ]);

    }
}
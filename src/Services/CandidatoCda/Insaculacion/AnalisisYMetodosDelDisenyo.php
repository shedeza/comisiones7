<?php

namespace App\Services\CandidatoCda\Insaculacion;

use App\Services\CandidatoCda\NewSeleccionaCDA;
use App\Utils\Area;
use App\Utils\Unidad;

class AnalisisYMetodosDelDisenyo {

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
            'claveComisionDictaminadora' => Area::ANALISIS_Y_METODOS_DEL_DISENYO
        ];        

        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::AZC
        ]);
        for($i =  1; $i < 4; $i++) {
            /**
             * AZC - 1 T, 1 S  
             */
            ($this->newSeleccionaCDA)($param, 'T', $i);

            ($this->newSeleccionaCDA)($param, 'S', $i);
        }

        $param = \array_merge($parameters, [
            'claveUnidad' => Unidad::XOC
        ]);
        for($i =  4; $i < 7; $i++) {
            /**
             * XOC - 1 T, 1 S  
             */
            ($this->newSeleccionaCDA)($param, 'T', $i);

            ($this->newSeleccionaCDA)($param, 'S', $i);
        }

       
    }
}
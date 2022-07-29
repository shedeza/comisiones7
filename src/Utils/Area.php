<?php

namespace App\Utils;

class Area {

    const CIENCIAS_BASICAS                   = 1;
    const INGENIERIA                         = 2;
    const CIENCIAS_BIOLOGICAS                = 3;
    const CIENCIAS_DE_LA_SALUD               = 4;
    const CIENCIAS_SOCIALES                  = 5;
    const CIENCIAS_ECONOMICO_ADMINISTRATIVAS = 6;
    const HUMANIDADES                        = 7;
    const ANALISIS_Y_METODOS_DEL_DISENYO     = 8;
    const PRODUCCION_Y_CONTEXTO_DEL_DISENYO  = 9;

    const AREAS = [
        1 => 'Ciencias Básicas',
        2 => 'Ingeniería',
        3 => 'Ciencias Biológicas',
        4 => 'Ciencias de la Salud',
        5 => 'Ciencias Sociales',
        6 => 'Ciencias Económico – Administrativas',
        7 => 'Humanidades',
        8 => 'Análisis y Métodos del Diseño',
        9 => 'Producción y Contexto del Diseño',
    ];


    public function getNombre(int $id) : String
    {
        return self::AREAS[$id];
    }

    public function getAll(){
        return self::AREAS;
    }
}
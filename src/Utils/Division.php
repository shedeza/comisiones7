<?php

namespace App\Utils;

class Division
{
    const CBI = "002";
    const CSH = "003";
    const CBS = "004";
    const CAD = "005";
    const CNI = "007";
    const CCD = "008";

    private const DIVISIONES = [
        "002" => ["clave" => "002", "nombre" => "Ciencias Básicas e Ingeniería", "abreviatura" => "CBI"],
        "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abreviatura" => "CSH"],
        "004" => ["clave" => "004", "nombre" => "Ciencias Biológicas y de la Salud", "abreviatura" => "CBS"],
        "005" => ["clave" => "005", "nombre" => "Ciencias y Artes para el Diseño", "abreviatura" => "CAD"],
        "007" => ["clave" => "007", "nombre" => "Ciencias Naturales e Ingeniería", "abreviatura" => "CNI"],
        "008" => ["clave" => "008", "nombre" => "Ciencias de la Comunicación y Diseño", "abreviatura" => "CCD"],
    ];

    public static function getNombre(string $code) :?string
    {
        if(in_array($code, array_keys(self::DIVISIONES))){
            return self::DIVISIONES[$code]['nombre'];
        }

        return null;
    }

    public static function getDivisiones() :array
    {
        return self::DIVISIONES;
    }

    public static function getDivision(string $code) :?array
    {
        if(in_array($code, array_keys(self::DIVISIONES))){
            return self::DIVISIONES[$code];
        }

        return null;
    }

    static function getDivisionesType()
    {
        $divisiones = [
            "Ciencias Básicas e Ingeniería" => "002",
            "Ciencias Sociales y Humanidades" => "003",
            "Ciencias Biológicas y de la Salud" => "004",
            "Ciencias y Artes para el Diseño" => "005",
            "Ciencias Naturales e Ingeniería" => "007",
            "Ciencias de la Comunicación y Diseño" => "008",
        ];

        return $divisiones;
    }
}
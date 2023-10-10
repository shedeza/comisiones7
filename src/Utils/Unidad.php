<?php

namespace App\Utils;

class Unidad
{
    const IZT = "001";
    const AZC = "002";
    const XOC = "003";
    const CUA = "004";
    const LER = "005";
    
    private const UNIDADES = [
        '001' => ["clave" => '001', "nombre" => "IZTAPALAPA", "abreviatura" => "IZT"],
        "002" => ["clave" => "002", "nombre" => "AZCAPOTZALCO", "abreviatura" => "AZC"],
        "003" => ["clave" => "003", "nombre" => "XOCHIMILCO", "abreviatura" => "XOC"],
        "004" => ["clave" => "004", "nombre" => "CUAJIMALPA", "abreviatura" => "CUA"],
        "005" => ["clave" => "005", "nombre" => "LERMA", "abreviatura" => "LER"]
    ];


    public static function getNombre(string $code) :?string
    {

        if(in_array($code, array_keys(self::UNIDADES))){
            return self::UNIDADES[$code]['nombre'];
        }

        return null;
    }
   
    public static function getUnidades() :array
    {
        return self::UNIDADES;
    }

    public static function getUnidad(string $code) :?array
    {

        if(in_array($code, array_keys(self::UNIDADES))){
            return self::UNIDADES[$code];
        }

        return null;
    }
    
    public static function getDivisiones($unidad) :?array
    {
        $divisiones = [
            "001" => [
                "002" => ["clave" => "002", "nombre" => "Ciencias Básicas e Ingeniería", "abrebiatura" => "CBI", "numeroDepartamentos" => 5],
                "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abrebiatura" => "CSH", "numeroDepartamentos" => 4],
                "004" => ["clave" => "004", "nombre" => "Ciencias Biológicas y de la Salud", "abrebiatura" => "CBS", "numeroDepartamentos" => 5],
            ],
            "002" => [
                "002" => ["clave" => "002", "nombre" => "Ciencias Básicas e Ingeniería", "abrebiatura" => "CBI", "numeroDepartamentos" => 5],
                "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abrebiatura" => "CSH", "numeroDepartamentos" => 5],
                "005" => ["clave" => "005", "nombre" => "Ciencias y Artes para el Diseño", "abrebiatura" => "CAD", "numeroDepartamentos" => 4],
            ],
            "003" => [
                "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abrebiatura" => "CSH", "numeroDepartamentos" => 4],
                "004" => ["clave" => "004", "nombre" => "Ciencias Biológicas y de la Salud", "abrebiatura" => "CBS", "numeroDepartamentos" => 4],
                "005" => ["clave" => "005", "nombre" => "Ciencias y Artes para el Diseño", "abrebiatura" => "CAD", "numeroDepartamentos" => 4],
            ],
            "004" => [
                "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abrebiatura" => "CSH", "numeroDepartamentos" => 3],
                "007" => ["clave" => "007", "nombre" => "Ciencias Naturales e Ingeniería", "abrebiatura" => "CNI", "numeroDepartamentos" => 3],
                "008" => ["clave" => "008", "nombre" => "Ciencias de la Comunicación y Diseño", "abrebiatura" => "CCD", "numeroDepartamentos" => 3],
            ],
            "005" => [
                "002" => ["clave" => "002", "nombre" => "Ciencias Básicas e Ingeniería", "abrebiatura" => "CBI", "numeroDepartamentos" => 3],
                "003" => ["clave" => "003", "nombre" => "Ciencias Sociales y Humanidades", "abrebiatura" => "CSH", "numeroDepartamentos" => 3],
                "004" => ["clave" => "004", "nombre" => "Ciencias Biológicas y de la Salud", "abrebiatura" => "CBS", "numeroDepartamentos" => 3],
            ],
        ];

        if(in_array($unidad, array_keys($divisiones))){
            return $divisiones[$unidad];
        }

        return null; 
    }

    public static function getUnidadesType(): array
    {
        $unidades = [
            "Iztapalapa" =>'001',
            "Azcapotzalco" => '002',
            "Xochimilco" => "003",
            "Cuajimalpa" => "004",
            "Lerma" => "005",
        ];

        return $unidades;
    }
}
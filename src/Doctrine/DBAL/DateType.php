<?php

namespace App\Doctrine\DBAL;

use DateTime;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class DateType extends Type
{
    const MYTYPE = 'date'; // modify to match your type name

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getDateTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : new DateTime($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : $value->format('Y-m-d');
    }

    public function getName()
    {
        return self::MYTYPE; // modify to match your constant name
    }

    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return "convert('date', ?)";
    }

}
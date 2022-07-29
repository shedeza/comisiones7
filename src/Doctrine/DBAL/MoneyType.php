<?php


namespace App\Doctrine\DBAL;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MoneyType extends Type
{
    const MYTYPE = 'money'; // modify to match your type name

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getFloatDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : (float) $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : (float) $value;
    }

    public function getName()
    {
        return self::MYTYPE; // modify to match your constant name
    }

    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return "convert('money', ?)";
    }
}
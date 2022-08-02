<?php

namespace App\Doctrine\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class StringType extends Type
{
    const MYTYPE = 'string'; // modify to match your type name

    public function canRequireSQLConversion()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : utf8_encode($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : utf8_decode($value);
    }

    public function getName()
    {
        return self::MYTYPE;
    }
}
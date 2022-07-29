<?php

namespace App\AutoMapper;

use App\Entity\CandidatoCda;
use App\Entity\SeleccionCda;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface 
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(CandidatoCda::class, SeleccionCda::class);
    }
}
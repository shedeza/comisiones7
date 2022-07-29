<?php

namespace App\AutoMapper;

use App\Entity\CandidatoCda;
use App\Entity\CandidatoCdr;
use App\Entity\SeleccionCda;
use App\Entity\SeleccionCdr;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface 
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(CandidatoCda::class, SeleccionCda::class);
        $config->registerMapping(CandidatoCdr::class, SeleccionCdr::class);
    }
}
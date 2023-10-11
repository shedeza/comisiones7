<?php

namespace App\Services\CandidatoCda;

use App\Repository\CandidatoCdaRepository;
use App\Services\CandidatoCda\Insaculacion\AnalisisYMetodosDelDisenyo;
use App\Services\CandidatoCda\Insaculacion\CienciasBasicas;
use App\Services\CandidatoCda\Insaculacion\CienciasBiologicas;
use App\Services\CandidatoCda\Insaculacion\CienciasDeLaSalud;
use App\Services\CandidatoCda\Insaculacion\CienciasEconomicoAdministrativas;
use App\Services\CandidatoCda\Insaculacion\CienciasSociales;
use App\Services\CandidatoCda\Insaculacion\Humanidades;
use App\Services\CandidatoCda\Insaculacion\Ingenieria;
use App\Services\CandidatoCda\Insaculacion\ProduccionYContextoDelDisenyo;
use App\Utils\Area;
use Symfony\Component\Lock\LockFactory;

class Insaculacion {

    private $cienciasBasicas;
    private $ingenieria;
    private $cienciasBiologicas;
    private $cienciasDeLaSalud;
    private $cienciasSociales;
    private $cienciasEconomicoAdministrativas;
    private $humanidades;
    private $analisisYMetodosDelDisenyo;
    private $produccionYContextoDelDisenyo;
    private LockFactory $lockFactory;

    private $candidatoCdaRepository;

    public function __construct(
        CienciasBasicas $cienciasBasicas,
        Ingenieria $ingenieria,
        CienciasBiologicas $cienciasBiologicas,
        CienciasDeLaSalud $cienciasDeLaSalud,
        CienciasSociales $cienciasSociales,
        CienciasEconomicoAdministrativas $cienciasEconomicoAdministrativas,
        Humanidades $humanidades,
        AnalisisYMetodosDelDisenyo $analisisYMetodosDelDisenyo,
        ProduccionYContextoDelDisenyo $produccionYContextoDelDisenyo,
        CandidatoCdaRepository $candidatoCdaRepository,
        LockFactory $lockFactory
    )
    {
        $this->cienciasBasicas = $cienciasBasicas;
        $this->ingenieria = $ingenieria;
        $this->cienciasBiologicas = $cienciasBiologicas;
        $this->cienciasDeLaSalud = $cienciasDeLaSalud;
        $this->cienciasSociales = $cienciasSociales;
        $this->cienciasEconomicoAdministrativas = $cienciasEconomicoAdministrativas;
        $this->humanidades = $humanidades;
        $this->analisisYMetodosDelDisenyo = $analisisYMetodosDelDisenyo;
        $this->produccionYContextoDelDisenyo = $produccionYContextoDelDisenyo;
        $this->candidatoCdaRepository =  $candidatoCdaRepository;
        $this->lockFactory = $lockFactory;
    }

    public function __invoke($area = null)
    {
     
        $lock = $this->lockFactory->createLock(1000);
        /** Bloqueo inicio */
        $lock->acquire(true);

        if($area){
            $this->candidatoCdaRepository->preparaSorteo($area);

            if($area == Area::CIENCIAS_BASICAS){
                ($this->cienciasBasicas)();
            }
            if($area == Area::INGENIERIA){
                ($this->ingenieria)();
            }
            if($area == Area::CIENCIAS_BIOLOGICAS){
                ($this->cienciasBiologicas)();
            }
            if($area == Area::CIENCIAS_DE_LA_SALUD){
                ($this->cienciasDeLaSalud)();
            }
            if($area == Area::CIENCIAS_SOCIALES){
                ($this->cienciasSociales)();
            }
            if($area == Area::CIENCIAS_ECONOMICO_ADMINISTRATIVAS){
                ($this->cienciasEconomicoAdministrativas)();
            }
            if($area == Area::HUMANIDADES){
                ($this->humanidades)();
            }
            if($area == Area::ANALISIS_Y_METODOS_DEL_DISENYO){
                ($this->analisisYMetodosDelDisenyo)();
            }
            if($area == Area::PRODUCCION_Y_CONTEXTO_DEL_DISENYO){
                ($this->produccionYContextoDelDisenyo)();
            }

        } else {
            $this->candidatoCdaRepository->preparaSorteo();

            ($this->cienciasBasicas)();
            ($this->ingenieria)();
            ($this->cienciasBiologicas)();
            ($this->cienciasDeLaSalud)();
            ($this->cienciasSociales)();
            ($this->cienciasEconomicoAdministrativas)();
            ($this->humanidades)();
            ($this->analisisYMetodosDelDisenyo)();
            ($this->produccionYContextoDelDisenyo)();
        }

        $lock->release();
    }

}
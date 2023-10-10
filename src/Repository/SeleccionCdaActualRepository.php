<?php

namespace App\Repository;

use App\Entity\SeleccionCdaActual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method CandidatoCdaFinal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatoCdaFinal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatoCdaFinal[]    findAll()
 * @method CandidatoCdaFinal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class  SeleccionCdaActualRepository extends ServiceEntityRepository
{
    private $trimestre;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeleccionCdaActual::class);

        $this->trimestre = "23P";
    }

    public function getByArea(int $area, string $titSup){
        $dql = "
            SELECT s
                FROM App:SeleccionCdaActual s
                    WHERE s.claveComisionDictaminadora = :area
                        AND s.titularSuplente = :titSup
                ORDER BY s.titularSuplente DESC, s.nombreUnidad ASC, s.nombreDivision ASC, s.nombreDisciplina ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('titSup', $titSup);
        $consulta->setParameter('area', $area);

        return $consulta->getArrayResult();
    }
}

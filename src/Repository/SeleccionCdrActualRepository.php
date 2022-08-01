<?php

namespace App\Repository;

use App\Entity\SeleccionCdrActual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method CandidatoCdrFinal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatoCdrFinal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatoCdrFinal[]    findAll()
 * @method CandidatoCdrFinal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class  SeleccionCdrActualRepository extends ServiceEntityRepository
{
    private $trimestre;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeleccionCdrActual::class);

        $this->trimestre = "22I";
    }

    public function getByTipo(string $titSup){
        $dql = "
            SELECT s
                FROM App:SeleccionCdrActual s
                    WHERE s.titularSuplente = :titSup
                ORDER BY s.titularSuplente DESC, s.nombreUnidad ASC, s.nombreDivision ASC, s.nombreDisciplina ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('titSup', $titSup);

        return $consulta->getArrayResult();
    }
}

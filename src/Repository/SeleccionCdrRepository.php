<?php

namespace App\Repository;

use App\Entity\CandidatoCdr;
use App\Entity\SeleccionCdr;
use AutoMapperPlus\AutoMapperInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method SeleccionCdr|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeleccionCdr|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeleccionCdr[]    findAll()
 * @method SeleccionCdr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeleccionCdrRepository extends ServiceEntityRepository
{
    private $trimestre;
    private $mapper;

    public function __construct(
        ManagerRegistry $registry,
        AutoMapperInterface $mapper
    )
    {
        parent::__construct($registry, SeleccionCdr::class);
        $this->mapper = $mapper;
        $this->trimestre = "22I";
    }

    public function gelAll(){
        $dql = "
            SELECT s.nomAux, s.claveUnidadRepresentada, s.claveDivisionRepresentada, s.nombreUnidad, s.nombreDivision, s.nombreDepartamento, s.genero, s.titularSuplente, c.nombre
                FROM App:SeleccionCdr s
                    LEFT JOIN App:CandidatoCdr c WITH c.empleado = s.empleado
                ORDER BY s.titularSuplente DESC, s.claveUnidadRepresentada ASC, s.claveDivisionRepresentada ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);

        return $consulta->getArrayResult();
    }

    public function guardaSeleccion(CandidatoCdr $candidatoCdr) : SeleccionCdr
    {

        /** @var SeleccionCdr $seleccionCdr */
        $seleccionCdr = $this->mapper->map($candidatoCdr, SeleccionCdr::class);

        $this->getEntityManager()->persist($seleccionCdr);
        try{
            $this->getEntityManager()->flush();
        } catch(Exception $e) {

        }

        return $seleccionCdr;
    }

    public function borraSeleccion(int $area = null){
        $em = $this->getEntityManager();

        $where = " WHERE c.trimestre = :trimestre";

        /**
         * Se borran los elementos que existan seleccioandos
         */
        $query = "
            DELETE App:SeleccionCdr c
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->execute();        
  
        /**
         * Se establese el campo seleccion y titularSuplente a null en la entidad Candidato
         */
        $query = "
            UPDATE App:CandidatoCdr c SET c.seleccion = NULL, c.titularSuplente = NULL, c.aleatorio = NULL
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);

        $consulta->execute();
    }
}

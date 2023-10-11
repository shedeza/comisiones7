<?php

namespace App\Repository;

use App\Entity\CandidatoCda;
use App\Entity\SeleccionCda;
use AutoMapperPlus\AutoMapperInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method SeleccionCda|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeleccionCda|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeleccionCda[]    findAll()
 * @method SeleccionCda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeleccionCdaRepository extends ServiceEntityRepository
{
    private $trimestre;
    private $mapper;

    public function __construct(
        ManagerRegistry $registry, 
        AutoMapperInterface $mapper
    )
    {
        parent::__construct($registry, SeleccionCda::class);
        $this->mapper = $mapper;
        $this->trimestre = "23P";
    }

    public function save(SeleccionCda $seleccionCda) : SeleccionCda
    {
        $this->getEntityManager()->persist($seleccionCda);
        $this->getEntityManager()->flush();

        return $seleccionCda;
    }

    public function getAll(){
        $dql = "
            SELECT s.empleado, s.claveComisionDictaminadora, s.nomAux, s.nombreUnidad, s.nombreDivision, s.nombreDisciplina, s.nombreDepartamento, s.genero, s.titularSuplente, c.nombre
                FROM App:SeleccionCda s
                    LEFT JOIN App:CandidatoCda c WITH c.empleado = s.empleado
                    WHERE c.trimestre = :trimestre 
                    ORDER BY s.claveComisionDictaminadora ASC, s.titularSuplente DESC, s.claveUnidadRepresentada ASC, s.nombreDisciplina ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('trimestre', $this->trimestre);

        return $consulta->getArrayResult();
    }

    public function countAll(){
        $dql = "
            SELECT count(s)
                FROM App:SeleccionCda s
                    LEFT JOIN App:CandidatoCda c WITH c.empleado = s.empleado
                    WHERE c.trimestre = :trimestre 
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('trimestre', $this->trimestre);

        return $consulta->getSingleScalarResult();
    }

    public function getByArea(int $area){
        $dql = "
            SELECT s.empleado, s.claveComisionDictaminadora, s.nomAux, s.nombreUnidad, s.nombreDivision, s.nombreDisciplina, s.nombreDepartamento, s.genero, s.titularSuplente, s.nombreUnidadRepresentada, c.nombre
                FROM App:SeleccionCda s
                    LEFT JOIN App:CandidatoCda c WITH c.empleado = s.empleado
                    WHERE c.trimestre = :trimestre 
                        AND c.claveComisionDictaminadora = :area
                ORDER BY s.titularSuplente DESC, s.claveUnidadRepresentada ASC, s.claveDisiplina ASC, s.nombreDisciplina ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);

        return $consulta->getArrayResult();
    }

    public function getByAreaTipo(int $area, string $titSup){
        $dql = "
            SELECT s.empleado, s.claveComisionDictaminadora, s.nomAux, s.nombreUnidad, s.nombreDivision, s.nombreDisciplina, s.nombreDepartamento, s.genero, s.titularSuplente, c.nombre
                FROM App:SeleccionCda s
                    LEFT JOIN App:CandidatoCda c WITH c.empleado = s.empleado
                    WHERE c.trimestre = :trimestre 
                        AND c.claveComisionDictaminadora = :area
                        AND s.titularSuplente = :titSup
                ORDER BY s.titularSuplente DESC, s.claveUnidadRepresentada ASC, s.claveDisiplina ASC, s.nombreDisciplina ASC
        ";

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);
        $consulta->setParameter('titSup', $titSup);

        return $consulta->getArrayResult();
    }


    public function guardaSeleccion(CandidatoCda $candidatoCda, ?array $representa = null) : SeleccionCda
    {

        /** @var SeleccionCda $seleccionCda */
        $seleccionCda = $this->mapper->map($candidatoCda, SeleccionCda::class);
        if(!empty($representa)) {
            $seleccionCda->setClaveUnidadRepresentada($representa['unidad']['clave']);
            //$seleccionCda->setClaveDivisionRepresentada($representa['division']['clave']);
            $seleccionCda->setNombreUnidadRepresentada($representa['unidad']['nombre']);
           // $seleccionCda->setNombreDivisionRepresentada($representa['division']['nombre']);
        } 

        $this->getEntityManager()->persist($seleccionCda);
        try{
            $this->getEntityManager()->flush();
        } catch(Exception $e) {

        }

        return $seleccionCda;
    }

    public function borraSeleccion(int $area = null){
        $em = $this->getEntityManager();

        $where = " WHERE c.trimestre = :trimestre";
        if($area){
            $where .= " AND c.claveComisionDictaminadora = :area";
        }

        /**
         * Se borran los elementos que existan seleccioandos
         */
        $query = "
            DELETE App:SeleccionCda c
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        if($area){
            $consulta->setParameter('area', $area);
        }
        $consulta->execute();        
  
        /**
         * Se establese el campo seleccion y titularSuplente a null en la entidad Candidato
         */
        $query = "
            UPDATE App:CandidatoCda c SET c.seleccion = NULL, c.titularSuplente = NULL, c.aleatorio = NULL
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        if($area){
            $consulta->setParameter('area', $area);
        }
        $consulta->execute();
    }
}

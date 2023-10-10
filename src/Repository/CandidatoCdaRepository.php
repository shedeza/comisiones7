<?php

namespace App\Repository;

use App\Entity\CandidatoCda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method CandidatoCda|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatoCda|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatoCda[]    findAll()
 * @method CandidatoCda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class  CandidatoCdaRepository extends ServiceEntityRepository
{
    private $trimestre;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatoCda::class);

        $this->trimestre = "23P";
    }

    public function save(CandidatoCda $candidatoCda) : CandidatoCda
    {
        $this->getEntityManager()->persist($candidatoCda);
        $this->getEntityManager()->flush();

        return $candidatoCda;
    }

    public function seleccionado(CandidatoCda $candidatoCda, ?array $representa = null) : CandidatoCda
    {
        $candidatoCda->setSeleccion('X');
        if(!empty($representa)) {
            $candidatoCda->setClaveUnidadRepresentada($representa['unidad']['clave']);
           // $candidatoCda->setClaveDivisionRepresentada($representa['division']['clave']);
            $candidatoCda->setNombreUnidadRepresentada($representa['unidad']['nombre']);
           // $candidatoCda->setNombreDivisionRepresentada($representa['division']['nombre']);
        } else {
            $candidatoCda->setClaveUnidadRepresentada($candidatoCda->getClaveUnidad());
            $candidatoCda->setClaveDivisionRepresentada($candidatoCda->getClaveDivision());
            $candidatoCda->setNombreUnidadRepresentada($candidatoCda->getNombreUnidad());
            $candidatoCda->setNombreDivisionRepresentada($candidatoCda->getNombreDivision());
        }
        $this->getEntityManager()->persist($candidatoCda);
        $this->getEntityManager()->flush();

        return $candidatoCda;
    }

    public function getAll(){
        $em = $this->getEntityManager();
        $query = "
            SELECT c FROM App:CandidatoCda c
                WHERE c.excluir IS NULL
                    AND c.trimestre = :trimestre
                ORDER BY c.claveComisionDictaminadora ASC, c.claveUnidad ASC, c.claveDivision ASC, c.nombreDisciplina ASC, c.genero ASC
        ";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        return $consulta->getResult();
    }

    public function getByArea($area){
        $em = $this->getEntityManager();
        $query = "
            SELECT c FROM App:CandidatoCda c
                WHERE c.excluir IS NULL
                    AND c.trimestre = :trimestre
                    AND c.claveComisionDictaminadora = :area
                ORDER BY c.claveComisionDictaminadora ASC, c.claveUnidad ASC, c.claveDivision ASC, c.nombreDisciplina ASC, c.genero ASC
        ";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);
        return $consulta->getResult();
    }

    public function countUnidades(int $area) : int
    {
        $em = $this->getEntityManager();
        $query = "
            SELECT COUNT(DISTINCT(c.claveUnidad)) FROM App:CandidatoCda c
                WHERE c.excluir IS NULL
                    AND c.trimestre = :trimestre
                    AND c.claveComisionDictaminadora = :area
        ";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);
        return $consulta->getSingleScalarResult();
    }

    public function countDisiplinas(int $area) : int
    {
        $em = $this->getEntityManager();
        $query = "
            SELECT COUNT(DISTINCT(c.nombreDisciplina)) FROM App:CandidatoCda c
                WHERE c.excluir IS NULL
                    AND c.trimestre = :trimestre
                    AND c.claveComisionDictaminadora = :area
        ";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);
        return $consulta->getSingleScalarResult();
    }

    public function countDepartamentos(int $area) : int
    {
        $em = $this->getEntityManager();
        $query = "
            SELECT COUNT(DISTINCT(c.nombreDepartamento)) FROM App:CandidatoCda c
                WHERE c.excluir IS NULL
                    AND c.trimestre = :trimestre
                    AND c.claveComisionDictaminadora = :area
        ";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->setParameter('area', $area);
        return $consulta->getSingleScalarResult();
    }

    public function preparaSorteo($area = null){
        $where = " WHERE o.trimestre = :trimestre";

        if($area){
            $where .= " AND o.claveComisionDictaminadora = :area";
        }

        $em = $this->getEntityManager();

        /**
         * Se borran los elementos que existan seleccioandos
         */
        $query = "
            DELETE App:SeleccionCda o
        ".$where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        if($area){
            $consulta->setParameter('area', $area);
        }
        $consulta->execute();

        /**
         * Se establese el campo seleccion y titularSuplente a null
         */
        $query = "
            UPDATE App:CandidatoCda o 
                SET o.seleccion = NULL, o.titularSuplente = NULL
        ".$where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        if($area){
            $consulta->setParameter('area', $area);
        }
        $consulta->execute();

        /**
         * Se genera un numero aleatoreo
         */
        $query = "
            UPDATE App:CandidatoCda o 
                SET o.aleatorio = RAND()    
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        if($area){
            $consulta->setParameter('area', $area);
        }

        try{
            $consulta->execute();
        } catch(Exception $e){
            dump($e);
        }
    }

    public function getCandidato($parameters, $unidad = [], $disiplina = []){
        $query = "
            SELECT c 
                FROM App:CandidatoCda c 
                WHERE c.excluir IS NULL 
                    AND c.seleccion IS NULL
                    AND c.trimestre = :trimestre
                    AND c.empleado NOT IN (11651)
        ";

        if(!empty($unidad)){
            $query .= ' AND c.claveUnidad NOT IN (:unidad) ';
        }

        if(!empty($disiplina)){
            $query .= ' AND c.nombreDisciplina NOT IN (:disiplina) ';
        }

        foreach($parameters AS $key => $parameter){
            $query .= ' AND c.'.$key.' = :'.$key;
        }

        $query .= ' ORDER BY c.aleatorio ASC';

        $consulta = $this->getEntityManager()->createQuery($query);
        $consulta->setParameters($parameters);
        $consulta->setParameter('trimestre', $this->trimestre);

        if(!empty($unidad)){
            $consulta->setParameter('unidad', $unidad);
        }

        if(!empty($disiplina)){
            $consulta->setParameter('disiplina', $disiplina);
        }
        
        $consulta->setMaxResults(1);
        return $consulta->getOneOrNullResult(); 
    }

    public function getCandidatoDepto($parameters, $unidad = [], $departamento = [])
    {
        $query = "
            SELECT c 
                FROM App:CandidatoCda c 
                WHERE c.excluir IS NULL 
                    AND c.seleccion IS NULL
                    AND c.trimestre = :trimestre
        ";

        if(!empty($unidad)){
            $query .= ' AND c.claveUnidad NOT IN (:unidad) ';
        }

        if($departamento) {
            $query .= ' AND c.nombreDepartamento NOT IN (:departamento) ';
        }

        foreach($parameters AS $key => $parameter){
            $query .= ' AND c.'.$key.' = :'.$key;
        }
        
        $query .= ' ORDER BY c.aleatorio ASC';

        $consulta = $this->getEntityManager()->createQuery($query);
        $consulta->setParameters($parameters);
        $consulta->setParameter('trimestre', $this->trimestre);

        if(!empty($unidad)){
            $consulta->setParameter('unidad', $unidad);
        }

        if($departamento) {
            $consulta->setParameter('departamento', $departamento);
        }

        $consulta->setMaxResults(1);
        return $consulta->getOneOrNullResult(); 
    }
}

<?php

namespace App\Repository;

use App\Entity\CandidatoCdr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method CandidatoCdr|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatoCdr|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatoCdr[]    findAll()
 * @method CandidatoCdr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatoCdrRepository extends ServiceEntityRepository
{
    private $trimestre;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatoCdr::class);

        $this->trimestre = "23P";
    }

    public function preparaSorteo(){

        $where = " WHERE o.trimestre = :trimestre";
        $em = $this->getEntityManager();

        /**
         * Se borran los elementos que existan seleccioandos
         */
        $query = "
            DELETE App:SeleccionCdr o
        ".$where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->execute();

        /**
         * Se establese el campo seleccion y titularSuplente a null
         */
        $query = "
            UPDATE App:CandidatoCdr o 
                SET o.seleccion = NULL, o.titularSuplente = NULL
        ".$where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);
        $consulta->execute();

        /**
         * Se genera un numero aleatoreo
         */
        $query = "
            UPDATE App:CandidatoCdr o 
                SET o.aleatorio = RAND()    
        ". $where;

        $consulta = $em->createQuery($query);
        $consulta->setParameter('trimestre', $this->trimestre);

        try{
            $consulta->execute();
        } catch(Exception $e){
            dump($e);
        }
    }

    public function getCandidato($parameters, $division = null){

        $query = "SELECT c FROM App:CandidatoCdr c WHERE c.excluir IS NULL AND c.seleccion IS NULL";

        if($division){
            $query .= " AND c.claveDivision NOT IN (:division) ";
        }

        foreach($parameters AS $key => $parameter){
            $query .= ' AND c.'.$key.' = :'.$key;
        }

        $query .= ' ORDER BY c.aleatorio ASC';

        $consulta = $this->getEntityManager()->createQuery($query);
        $consulta->setParameters($parameters);
        
        if($division){
            $consulta->setParameter('division', $division);
        }

        $consulta->setMaxResults(1);
     
        return $consulta->getOneOrNullResult(); 
    }

    public function seleccionado(CandidatoCdr $candidatoCdr) : CandidatoCdr
    {
        $candidatoCdr->setSeleccion('X');
        $candidatoCdr->setClaveUnidadRepresentada($candidatoCdr->getClaveUnidad());
        $candidatoCdr->setClaveDivisionRepresentada($candidatoCdr->getClaveDivision());
        $candidatoCdr->setNombreUnidadRepresentada($candidatoCdr->getNombreUnidad());
        $candidatoCdr->setNombreDivisionRepresentada($candidatoCdr->getNombreDivision());
        $this->getEntityManager()->persist($candidatoCdr);
        $this->getEntityManager()->flush();

        return $candidatoCdr;
    }
}

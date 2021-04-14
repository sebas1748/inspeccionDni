<?php

namespace App\Repository;

use App\Entity\DniRecibidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DniRecibidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DniRecibidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DniRecibidos[]    findAll()
 * @method DniRecibidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DniRecibidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DniRecibidos::class);
    }

    /**
     * @return DniRecibidos[] Returns an array of Personas objects
     */
    public function buscarPorDni($dni)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
        SELECT rec
        FROM App\Entity\DniRecibidos rec
        WHERE rec.dni = :dni
        ')
            ->setParameter('dni', $dni);
        return $query->getResult();
    }
    // /**
    //  * @return DniRecibidos[] Returns an array of DniRecibidos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DniRecibidos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

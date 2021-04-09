<?php

namespace App\Repository;

use App\Entity\Delegaciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Delegaciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delegaciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delegaciones[]    findAll()
 * @method Delegaciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelegacionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delegaciones::class);
    }

    // /**
    //  * @return Delegaciones[] Returns an array of Delegaciones objects
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
    public function findOneBySomeField($value): ?Delegaciones
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

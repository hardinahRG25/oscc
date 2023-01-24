<?php

namespace App\Repository;

use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mission>
 *
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    fin
 * dAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }

    public function add(Mission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMissionUserSelected(int $employee = null)
    {
        $qb =  $this->createQueryBuilder('m')
            ->select('m', 'u', 'c')
            ->leftJoin('m.employee', 'u')
            ->leftJoin('m.customer', 'c')
            ->addSelect('bm', 'um')
            ->leftJoin('c.businessManager', 'bm')
            ->leftJoin('c.unitManager', 'um')
            ->andWhere('m.employee = :val')
            ->setParameter('val', $employee)
            ->orderBy('m.date_start', 'DESC')
            ->setMaxResults(15);
        return $qb->getQuery()
            ->getArrayResult();
    }

    /**
     * a voir 
     */
    // public function findMissionUserSelected(): array
    // {
    //     $qb = $this->createQueryBuilder('m')
    //         ->select('m', 'u', 'c')
    //         ->leftJoin('m.employee', 'u')
    //         ->leftJoin('m.customer', 'c')
    //         ->addSelect('bm', 'um')
    //         ->leftJoin('c.businessManager', 'bm')
    //         ->leftJoin('c.unitManager', 'um');

    //     return $qb->getQuery()->getArrayResult();
    // }

    // public function findMissionManager(int $employee = null): array
    // {
    //     $qb = $this->createQueryBuilder('m');
    //     $select = "m,c,u";
    //     $query = $qb->select($select)
    //     ->
    // }

    //    /**
    //     * @return Mission[] Returns an array of Mission objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Mission
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


}

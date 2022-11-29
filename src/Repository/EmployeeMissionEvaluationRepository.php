<?php

namespace App\Repository;

use App\Entity\EmployeeMissionEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeMissionEvaluation>
 *
 * @method EmployeeMissionEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeMissionEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeMissionEvaluation[]    findAll()
 * @method EmployeeMissionEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeMissionEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeMissionEvaluation::class);
    }

    public function add(EmployeeMissionEvaluation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployeeMissionEvaluation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployeeMissionEvaluation[] Returns an array of EmployeeMissionEvaluation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmployeeMissionEvaluation
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

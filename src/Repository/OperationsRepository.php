<?php

namespace App\Repository;

use App\Entity\Operations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Operations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operations[]    findAll()
 * @method Operations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operations::class);
    }

    // /**
    //  * @return Operations[] Returns an array of Operations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Operations
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getOperations(){
        return $this->createQueryBuilder('o')
            ->select('o')
            ->orderBy('o.created_at', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    public function getOperationsList(){
        $operations = $this->getOperations();
        $list = [];
        foreach ($operations as $operation){
            $item = $operation;
            $item['direction_name']='';
            if (isset(array_flip(self::getDirectionsList())[$operation['direction']])){
                $item['direction_name']=array_flip(self::getDirectionsList())[$operation['direction']];
            }
            $list[]=$item;

        }
        return $list;

    }
    public function getDirectionsList(){
        return [
            'Income'=>Operations::DIRECTION_INCOME,
            'Outcome'=>Operations::DIRECTION_OUTCOME
        ];
    }
}

<?php

namespace App\Repository;

use App\Entity\Accounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Accounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accounts[]    findAll()
 * @method Accounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accounts::class);
    }

    // /**
    //  * @return Accounts[] Returns an array of Accounts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function getAccountsArr(){
        return $this->createQueryBuilder('a')
            ->select('a')
            ->andWhere('a.status = :s')
            ->setParameter('s', Accounts::STATUS_ACTIVE)
            ->orderBy('a.name', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function getAccountsList(){
        $parents = $this->getAccountsArr();
        $parents_list = [];
        foreach ($parents as $item) {
            $parents_list[ $item[ 'name' ] ] = $item[ 'id' ];
        }

        return $parents_list;
    }

    public function getCurrenciesList(){
        return [
            'UAH' => 'UAH',
            'USD' => 'USD',
        ];
    }

}

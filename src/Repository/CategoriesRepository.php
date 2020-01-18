<?php

namespace App\Repository;

use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categories::class);
    }

    // /**
    //  * @return Categories[] Returns an array of Categories objects
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
    public function findOneBySomeField($value): ?Categories
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getCategoriesAll(){
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.status = :s')
            ->setParameter('s', Categories::STATUS_VISIBLE)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function getCategoriesParent($as_array = false){
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.status = :s')
            ->andWhere('c.parent IS NULL')
            ->setParameter('s', Categories::STATUS_VISIBLE)
            ->orderBy('c.sort', 'ASC')
            ->orderBy('c.type', 'ASC')
            ->getQuery();
        if ($as_array){
            return $query->getArrayResult();
        }
        return $query->getResult();
    }

    public function getCategoriesIncome(){
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.status = :s')
            ->andWhere('c.parent_id IS NOT NULL')
            ->andWhere('c.type = '.Categories::TYPE_INCOME)
            ->setParameter('s', Categories::STATUS_VISIBLE)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function getCategoriesOutcome(){
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.status = :s')
            ->andWhere('c.parent_id IS NOT NULL')
            ->andWhere('c.type = '.Categories::TYPE_OUTCOME)
            ->setParameter('s', Categories::STATUS_VISIBLE)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function getCategoriesParentsList(){
        $parents = $this->getCategoriesParent();
        $list = [];
        foreach ($parents as $parent){
            $list[$parent->getName()] = [];
            $list[$parent->getName()]['type'] = '';
            if (isset(self::getTypesList()[$parent->getType()])){
                $list[$parent->getName()]['type'] = self::getTypesList()[$parent->getType()];
            }
            $list[$parent->getName()]['children'] = [];
            foreach($parent->getChildren() as $child){
                $list[$parent->getName()]['children'][] = $child->getName();
            }
        }

        return $list;
    }

    public static function getTypesList()
    {
        return [ Categories::TYPE_INCOME => 'Income', Categories::TYPE_OUTCOME => 'Outcome' ];
    }
}

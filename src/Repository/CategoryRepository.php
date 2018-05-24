<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

   /**
    * 全部分类
    *
    * @return Category[]
    */
    public function findByAllCategory()
    {
        $datas = $this->createQueryBuilder('c')->orderBy('c.id', 'ASC')->getQuery()->getResult();
        // for ($i = 0; $i < count($datas); $i++) {
        //     $datas[$i]->setParentid('path_name');
        //     // exit();
        // }
        $datas[0]->getPathName = (new Category)->getPathName();
        // dump($datas[0]->getPathName()); exit();
        return $datas;
    }


    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository\Category;

use App\Entity\Sport\Sport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category\Category;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findCategory(Sport $sport)
    {
        $query = $this->createQueryBuilder('c')->join('c.sport', 's')->where('s=:sport')->setParameter('sport', $sport);
        return $query->getQuery()->getResult();
    }

}

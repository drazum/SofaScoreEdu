<?php

namespace App\Repository\Competition;

use App\Entity\Category\Category;
use App\Entity\Competition\Competition;
use App\Entity\Sport\Sport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;


class CompetitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Competition::class);
    }

    public function findCompetition(Category $category, string $name)
    {
        $query = $this->createQueryBuilder('c')->where('c.category=:category')->andWhere('c.name=:name')
            ->setParameter('category', $category)
            ->setParameter('name', $name);
        return $query->getQuery()->getSingleResult(AbstractQuery::HYDRATE_OBJECT);
    }

}
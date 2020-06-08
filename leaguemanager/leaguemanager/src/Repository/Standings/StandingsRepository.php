<?php


namespace App\Repository\Standings;


use App\Entity\Standings\Standings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StandingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Standings::class);
    }

    public function getCompetitors()
    {
        $query = $this->createQueryBuilder('c')->select('competitor');
        return $query->getQuery()->getResult();
    }

}
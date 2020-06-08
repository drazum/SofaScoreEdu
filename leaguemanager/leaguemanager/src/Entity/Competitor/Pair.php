<?php


namespace App\Entity\Competitor;

use App\Entity\Country\Country;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Pair
 * @ORM\Entity(repositoryClass="App\Repository\Competitor\CompetitorRepository")
 * @package App\Entity\Competitor
 */
class Pair extends Competitor
{

}
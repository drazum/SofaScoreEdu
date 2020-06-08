<?php


namespace App\Entity\Standings;


use App\Entity\AbstractEntity;
use App\Entity\Season\Season;
use Doctrine\ORM\Mapping as ORM;



///**
// * Class Standings
// * @ORM\Entity(repositoryClass="App\Repository\Standings\StandingsRepository")
// * @package App\Entity\Standings
// */

/**
 * Class Standings
 * @ORM\Entity(repositoryClass="App\Repository\Standings\StandingsRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "home"=HomeStandings::class,
 *     "away"=AwayStandings::class,
 *     "total"=TotalStandings::class
 * })
 * @ORM\Table(name="standings")
 * @package App\Entity\Standings
 */
abstract class Standings extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=Season::class)
     * @var Season
     */
    private Season $season;


    /**
     * @return Season
     */
    public function getSeason(): Season
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason(Season $season): void
    {
        $this->season = $season;
    }
}
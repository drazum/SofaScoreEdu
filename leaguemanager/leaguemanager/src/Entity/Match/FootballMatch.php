<?php


namespace App\Entity\Match;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FootballMatch
 * @ORM\Entity(repositoryClass="App\Repository\Match\MatchRepository")
 * @package App\Entity\Match
 */
class FootballMatch extends Match
{
    private const FIRST_HALF = 4;
    private const SECOND_HALF = 5;
}
<?php


namespace App\Entity\Match;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class BasketballMatch
 * @ORM\Entity(repositoryClass="App\Repository\Match\MatchRepository")
 * @package App\Entity\Match
 */
class BasketballMatch extends Match
{
    private const FIRST_QUARTER = 4;
    private const SECOND_QUARTER = 5;
    private const THIRD_QUARTER = 6;
    private const FOURTH_QUARTER = 7;
    private const OVERTIME = 8;
}
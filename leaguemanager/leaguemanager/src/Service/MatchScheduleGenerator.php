<?php

namespace App\Service;

use App\Entity\Competition\Competition;
use App\Entity\Match\BasketballMatch;
use App\Entity\Match\FootballMatch;
use App\Entity\Match\Match;
use App\Entity\Score\Score;
use App\Entity\Season\Season;
use App\Entity\Sport\Sport;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class MatchScheduleGenerator
 * @package App\Service
 */
class MatchScheduleGenerator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function generateSchedule(array $competitors, Competition $competition, Season $season, Sport $sport)
    {
        if($sport->getName() == "Football")
        {
            $match = $this->entityManager->getRepository(FootballMatch::class)->findOneBy([
                'season' => $season,
                'competition' => $competition
            ]);
            if ($match != null)
            {
                return $match;
            }
            $match = new FootballMatch();
        }
        else
        {
            $match = $this->entityManager->getRepository(BasketballMatch::class)->findOneBy([
                'season' => $season,
                'competition' => $competition
            ]);
            if ($match != null)
            {
                return $match;
            }
            $match = new BasketballMatch();
        }

        shuffle($competitors);

        $seasonStart = $season->getSeasonStart();
        $seasonEnd = $season->getSeasonEnd();
        $daysDiff = $seasonStart->diff($seasonEnd)->format("%a");

        $noOfCompetitors = count($competitors);
        $noOfMatches = $competition->getSeasonMatches();
        $noOfGroups = floor($noOfCompetitors/($noOfMatches+1));

        $lastGroupResidue = $noOfCompetitors%$noOfMatches;
        if($lastGroupResidue == 0)
        {
            $noOfGroups++;
        }

        // Not really, but used only for time management
        $noOfAllMatches = $noOfCompetitors*$noOfMatches;
        $dayIncrement = $daysDiff/$noOfAllMatches;


        // Teams sorted to groups similiar or the same sizes (shuffled before).
        // Groups are determined by number of matches
        // Connect each team with every other team only inside its group
        for ($i = 0; $i < $noOfGroups; $i++)
        {
            $shift = $i*($noOfMatches+1);
            if($shift+$noOfMatches >= $noOfCompetitors){
                $noOfMatches--;
            }
            $tempNoOfMatches = 0;
            for ($j = $shift; $j <= $shift+$noOfMatches; $j++)
            {
                for ($k = $j+1; $k < $shift+$noOfMatches+1; $k++)
                {
                    $matchClass = get_class($match);
                    $match = new $matchClass();
                    $score = new Score();
                    $match->setSeason($season);
                    $match->setCompetition($competition);
                    $match->setHomeScore($score);
                    $match->setAwayScore($score);
                    $match->setStatus(0);
//                    $match->setWinnerCode(null);

                    $match->setHomeCompetitor($competitors[$j]);
                    $match->setAwayCompetitor($competitors[$k]);
                    $match->setMatchStart($seasonStart->modify('+' . $dayIncrement . ' day'));
                    $this->entityManager->persist($match);
                }
                $tempNoOfMatches++;
            }
        }
        $this->entityManager->flush();
        return 0;
    }

}
<?php


namespace App\Command;


use App\Entity\Category\Category;
use App\Entity\Competition\Competition;
use App\Entity\Competitor\Competitor;
use App\Entity\Competitor\Team;
use App\Entity\Competitor\Teams;
use App\Entity\Country\Country;
use App\Entity\Match\FootballMatch;
use App\Entity\Match\Match;
use App\Entity\Season\Season;
use App\Entity\Sport\Sport;
use App\Entity\Standings\HomeStandings;
use App\Entity\Standings\AwayStandings;
use App\Entity\Standings\TotalStandings;
use App\Entity\Standings\Standings;
use App\Entity\Standings\StandingsRow;
use App\Helper\SlugHelper\SlugHelper;
use App\Service\MatchScheduleGenerator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\Persisters\Collection;

class SyntheticDataCommand extends Command
{
    protected EntityManagerInterface $entityManager;
    protected MatchScheduleGenerator $matchScheduleGenerator;

    public function __construct(EntityManagerInterface $entityManager, MatchScheduleGenerator $matchScheduleGenerator)
    {
        parent::__construct('syntheticdata');
        $this->entityManager = $entityManager;
        $this->matchScheduleGenerator = $matchScheduleGenerator;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        // Let's assume we have only two sports, pick randomly one of these two
        $sportId = rand(1,2);
        $sport = $this->entityManager->getRepository(Sport::class)->find($sportId);

        // Generate Category
        $category = $this->generateCategory($sport);

        // Generate Competition
        $competition = $this->generateCompetition($category);

        // Generate Season
        $season = $this->generateSeason($competition);

        // Generate array of competitors
        $competitors = $this->generateCompetitors($sport);

        // Generate Standings
        $standingsRow = $this->generateStandings($season, $competitors);

        $matchSchedule = $this->matchScheduleGenerator->generateSchedule($competitors, $competition, $season, $sport);

        return 0;
    }

    /**
     * @param int $minChars
     * @param int $maxChars
     * @return string
     */
    private function randomStringGenerator(int $minChars, int $maxChars): string
    {
        $length = rand($minChars, $maxChars);
        $chars = array_merge(range('a', 'z'), [" "]);
        $word = "";
        for($i = 0; $i < $length;$i++){
            $word .= $chars[rand(0,sizeof($chars) - 1)];
        }
        return $word;
    }

    /**
     * @param Sport $sport
     * @return Category
     */
    private function generateCategory(Sport $sport): Category
    {
        // Generate Category
        $categoryName = $this->randomStringGenerator(5, 7);
        $categoryName = ucwords(trim($categoryName));
        $categorySlug = SlugHelper::slugify($categoryName);

        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
        if($category == null)
        {
            $category = new Category();
            $category->setName($categoryName);
            $category->setSlug($categorySlug);
        }
        if(!$category->getSport()->contains($sport))
        {
            $sportCollection = $category->getSport();
            $sportCollection->add($sport);
            $category->setSport($sportCollection);
            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }
        return $category;
    }

    /**
     * @param Category $category
     * @return Competition
     */
    private function generateCompetition(Category $category): Competition
    {
        $competitionName = $this->randomStringGenerator(5, 7);
        $competitionName = ucwords(trim($competitionName));
        $competitionSlug = SlugHelper::slugify($competitionName);

        // Get all Competitions with same name
        $competition = $this->entityManager->getRepository(Competition::class)->findOneBy([
            'name' => $competitionName,
            'category' => $category
        ]);

        if($competition != null)
        {
            return $competition;
        }

        // If Competition doesn't exist, create new one
        $competition = new Competition();
        $competition->setName($competitionName);
        $competition->setSlug($competitionSlug);
        $competition->setCategory($category);
        $competition->setSeasonMatches(rand(1, 5));
        $this->entityManager->persist($competition);
        $this->entityManager->flush();
        return $competition;
    }

    /**
     * @param Competition $competition
     * @return Season
     * @throws \Exception
     */
    private function generateSeason(Competition $competition): Season
    {
        $firstYear = rand(2010, 2020);
        $secondYear = ($firstYear % 100) + 1;
        $seasonName = $firstYear . "-" . $secondYear;

        $seasonDuration = rand(7, 11);
        $startMonth = rand(1, 12);
        $endMonth = $startMonth + $seasonDuration;
        $startDate = new \DateTime($firstYear . "-" . rand(1, 12) . "-" . "1");
        if($endMonth > 12)
        {
            $endDate = new \DateTime(($firstYear + 1) . "-" . ($endMonth % 12) . "-" . "1");
        }
        else
        {
            $endDate = new \DateTime($firstYear . "-" . $endMonth . "-" . "1");
        }
        $startDate->format("y-m-d");
        $endDate->format("y-m-d");
        $season = $this->entityManager->getRepository(Season::class)->findOneBy([
            'name' => $seasonName,
            'competition' => $competition
        ]);

        if($season !== null)
        {
            return $season;
        }

        $season = new Season();
        $season->setName($seasonName);
        $season->setSeasonStart($startDate);
        $season->setSeasonEnd($endDate);
        $season->setCompetition($competition);
        $this->entityManager->persist($season);
        $this->entityManager->flush();
        return $season;
    }

    /**
     * Generating only teams(representations), because only football
     * and basketball are supported.
     *
     * @param Sport $sport
     * @return array
     */
    private function generateCompetitors(Sport $sport): array
    {
        $competitors = [];
        if($sport->getName() === "Football")
        {
            $teams = Teams::$footballTeams;
        }
        else
        {
            $teams = Teams::$basketballTeams;
        }

        $country = new Country();
        foreach ($teams as $team)
        {
            $country->setIso($team[Teams::ALPHA3]);
            $t = $this->entityManager->getRepository(Competitor::class)->findOneBy([
                'name' => $team[Teams::NAME],
                'sport' => $sport
            ]);
            if($t == null)
            {
                $t = new Team();
                $t->setName($team[Teams::NAME]);
                $t->setSlug(SlugHelper::slugify($team[Teams::NAME]));
                $t->setSport($sport);
                $t->setIso($country->getIso());
                $this->entityManager->persist($t);
                $this->entityManager->flush();
            }
            array_push($competitors, $t);
        }
        return $competitors;
    }

    private function initStandingsRow(Competitor $competitor, Standings $standings): StandingsRow
    {
        $standingsRow = new StandingsRow();
        $standingsRow->setScoresFor(0);
        $standingsRow->setWins(0);
        $standingsRow->setScoresAgainst(0);
        $standingsRow->setPoints(0);
        $standingsRow->setPercentage(0);
        $standingsRow->setMatches(0);
        $standingsRow->setLosses(0);
        $standingsRow->setDraws(0);
        $standingsRow->setCompetitor($competitor);
        $standingsRow->setStandings($standings);
        return $standingsRow;
    }

    private function generateStandings(Season $season, array $competitors): StandingsRow
    {
        // HOME STANDINGS
        $homeStandings = $this->entityManager->getRepository(HomeStandings::class)->findOneBy([
            'season' => $season,
        ]);
        if ($homeStandings == null)
        {
            $homeStandings = new HomeStandings();
            $homeStandings->setSeason($season);
            $this->entityManager->persist($homeStandings);
        }

        // AWAY STANDINGS
        $awayStandings = $this->entityManager->getRepository(AwayStandings::class)->findOneBy([
            'season' => $season,
        ]);
        if ($awayStandings == null)
        {
            $awayStandings = new AwayStandings();
            $awayStandings->setSeason($season);
            $this->entityManager->persist($awayStandings);
        }

        // TOTAL STANDINGS
        $totalStandings = $this->entityManager->getRepository(TotalStandings::class)->findOneBy([
            'season' => $season,
        ]);
        if ($totalStandings == null)
        {
            $totalStandings = new TotalStandings();
            $totalStandings->setSeason($season);
            $this->entityManager->persist($totalStandings);
        }

        // Check for each competitior its standings
        foreach ($competitors as $competitor)
        {
            // Check home standings
            $standingsRow = $this->entityManager->getRepository(StandingsRow::class)->findOneBy([
                'standings' => $homeStandings,
                'competitor' => $competitor
            ]);
            if ($standingsRow == null)
            {
                $standingsRow = $this->initStandingsRow($competitor, $homeStandings);
                $this->entityManager->persist($standingsRow);
            }

            // Check away standings
            $standingsRow = $this->entityManager->getRepository(StandingsRow::class)->findOneBy([
                'standings' => $awayStandings,
                'competitor' => $competitor
            ]);
            if ($standingsRow == null)
            {
                $standingsRow = $this->initStandingsRow($competitor, $awayStandings);
                $this->entityManager->persist($standingsRow);
            }

            // Check total standings
            $standingsRow = $this->entityManager->getRepository(StandingsRow::class)->findOneBy([
                'standings' => $totalStandings,
                'competitor' => $competitor
            ]);
            if ($standingsRow == null)
            {
                $standingsRow = $this->initStandingsRow($competitor, $totalStandings);
                $this->entityManager->persist($standingsRow);
            }

            $this->entityManager->flush();
        }
        return $standingsRow;
        return [$homeStandings, $awayStandings, $totalStandings];
    }
}
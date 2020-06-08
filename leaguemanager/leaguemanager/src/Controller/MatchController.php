<?php


namespace App\Controller;


use App\Entity\Competition\Competition;
use App\Entity\Season\Season;
use App\Entity\Standings\Standings;
use App\Entity\Standings\StandingsRow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchController
 *
 * @package App\Controller
 */
class MatchController extends AbstractController
{

    /**
     * @Route("/{id}")
     * @param Standings $standings
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function standingsRowEntity(Standings $standings, EntityManagerInterface $entityManager)
    {
        $standingsRow = $entityManager->getRepository(StandingsRow::class)->findBy([
            'standings' => $standings
        ]);

        if (count($standingsRow) === 0) {
            throw new NotFoundHttpException();
        }

        return new JsonResponse($this->get('serializer')->serialize($standingsRow, 'json'), Response::HTTP_OK, [],true);
    }

    /**
     * @Route("/{competition}/{season}")
     * @param string $competition
     * @param string $season
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function standingsEntity(string $competition, string $season, EntityManagerInterface $entityManager)
    {
        $competition = $entityManager->getRepository(Competition::class)->findBy([
            'slug' => $competition
        ]);
        $season = $entityManager->getRepository(Season::class)->findBy([
            'name' => $season,
            'competition' => $competition
        ]);
        $standings = $entityManager->getRepository(Standings::class)->findBy([
            'season' => $season,
        ]);

        return new JsonResponse($this->get('serializer')->serialize($standings, 'json'), Response::HTTP_OK, [],true);
    }

}
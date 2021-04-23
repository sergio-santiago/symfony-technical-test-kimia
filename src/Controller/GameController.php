<?php

namespace App\Controller;

use App\Form\GameType;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use App\Services\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game_index", methods={"GET"})
     */
    public function index(): Response
    {

        $form = $this->createForm(GameType::class);

        return $this->render(
            'game/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/ajax-random-players", name="game_ajax_random_players", methods={"GET"})
     */
    public function ajaxRandomPlayers(PlayerRepository $playerRepository, Serializer $serializer): Response
    {
        $players = $playerRepository->findAll();

        $indexesRandomPlayers = array_rand($players, 10);

        $randomPlayers = [];
        foreach ($indexesRandomPlayers as $index) {
            $randomPlayers[] = $players[$index];
        }

        $data = $serializer->jsonSerialize($randomPlayers, ['players_serialization']);

        return new Response($data);
    }

    /**
     * @Route("/ajax-teams", name="game_ajax_teams", methods={"GET"})
     */
    public function ajaxTeams(TeamRepository $teamRepository, Serializer $serializer): Response
    {
        $teams = $teamRepository->findAll();
        $data = $serializer->jsonSerialize($teams, ['teams_serialization']);

        return new Response($data);
    }
}
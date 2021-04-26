<?php

namespace App\Controller;

use App\Form\GameType;
use App\Repository\PlayerRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    public function ajaxRandomPlayers(PlayerRepository $playerRepository): Response
    {
        $players = $playerRepository->findAll();

        $indexesRandomPlayers = array_rand($players, 10);

        $randomPlayers = [];
        foreach ($indexesRandomPlayers as $index) {
            $randomPlayers[] = $players[$index];
        }

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new Serializer([new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);
        $responseJson = $serializer->serialize($randomPlayers, 'json', ['groups' => ['players_serialization']]);

        return new Response($responseJson);
    }
}
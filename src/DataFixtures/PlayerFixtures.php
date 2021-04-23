<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    private const REAL_MADRID_PLAYERS = [
        'Thibaut Courtois',
        'Sergio Ramos',
        'Casemiro',
        'Marco Asensio',
        'Isco',
        'Eden Hazard',
        'Toni Kroos',
        'Rodrygo',
        'Karim Benzema',
        'Éder Militão',
    ];

    private const BARCELONA_PLAYERS = [
        'Gerard Piqué',
        'Pedri',
        'Antoine Griezmann',
        'Ansu Fati',
        'Sergio Busquets',
        'Samuel Umtiti',
        'Sergi Roberto',
        'Jordi Alba',
        'Lionel Messi',
        'Ousmane Dembélé',
    ];

    public function load(ObjectManager $manager)
    {
        $this->loadTestPlayersForTeam($this->getReference(TeamFixtures::TEAM_MADRID_REFERENCE), $manager);
        $this->loadTestPlayersForTeam($this->getReference(TeamFixtures::TEAM_BARCELONA_REFERENCE), $manager);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TeamFixtures::class,
        ];
    }

    private function loadTestPlayersForTeam(Team $team, ObjectManager $manager): void
    {
        $players = [];
        switch ($team->getName()) {
            case "Real Madrid":
                $players = self::REAL_MADRID_PLAYERS;
                break;
            case "Barcelona":
                $players = self::BARCELONA_PLAYERS;
        }

        foreach ($players as $playerName) {
            $player = new Player();
            $player->setName($playerName);
            $player->setPosition(Player::POSITIONS[array_rand(Player::POSITIONS)]);
            $player->setTeam($team);

            $manager->persist($player);
        }
    }
}
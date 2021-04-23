<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public const TEAM_MADRID_REFERENCE = 'team_madrid_reference';
    public const TEAM_BARCELONA_REFERENCE = 'team_barcelona_reference';

    public function load(ObjectManager $manager)
    {
        $teamMadrid = new Team();
        $teamMadrid->setName('Real Madrid');
        $teamMadrid->setHexColor('#f3d9ff');
        $manager->persist($teamMadrid);

        $teamBarcelona = new Team();
        $teamBarcelona->setName('Barcelona');
        $teamBarcelona->setHexColor('#f7ffd9');
        $manager->persist($teamBarcelona);

        $manager->flush();

        $this->addReference(self::TEAM_MADRID_REFERENCE, $teamMadrid);
        $this->addReference(self::TEAM_BARCELONA_REFERENCE, $teamBarcelona);
    }
}
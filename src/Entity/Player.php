<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    public const POSITIONS = ['goalkeeper', 'defending', 'midfield', 'forward'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"players_serialization"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"players_serialization"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices=Player::POSITIONS, message="Choose a valid position.")
     * @Groups({"players_serialization"})
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"players_serialization"})
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}

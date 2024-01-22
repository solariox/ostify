<?php

namespace App\Entity;

use App\Repository\StreakRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StreakRepository::class)]
class Streak
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\ManyToOne(inversedBy: 'streaks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $streaker = null;

    #[ORM\Column(length: 255)]
    private ?string $character = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getStreaker(): ?User
    {
        return $this->streaker;
    }

    public function setStreaker(?User $streaker): static
    {
        $this->streaker = $streaker;

        return $this;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function setCharacter(string $character): static
    {
        $this->character = $character;

        return $this;
    }
}

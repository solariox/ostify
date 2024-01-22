<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'streaker', targetEntity: Streak::class, orphanRemoval: true)]
    private Collection $streaks;

    public function __construct()
    {
        $this->streaks = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getEmail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Streak>
     */
    public function getStreaks(): Collection
    {
        return $this->streaks;
    }

    public function addStreak(Streak $streak): static
    {
        if (!$this->streaks->contains($streak)) {
            $this->streaks->add($streak);
            $streak->setStreaker($this);
        }

        return $this;
    }

    public function removeStreak(Streak $streak): static
    {
        if ($this->streaks->removeElement($streak)) {
            // set the owning side to null (unless already changed)
            if ($streak->getStreaker() === $this) {
                $streak->setStreaker(null);
            }
        }

        return $this;
    }
}

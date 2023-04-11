<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SpeLib;

    /**
     * @ORM\ManyToMany(targetEntity=Entreprise::class, inversedBy="specialites")
     */
    private $entreprise;

    public function __construct()
    {
        $this->entreprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeLib(): ?string
    {
        return $this->SpeLib;
    }

    public function setSpeLib(string $SpeLib): self
    {
        $this->SpeLib = $SpeLib;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprise(): Collection
    {
        return $this->entreprise;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprise->contains($entreprise)) {
            $this->entreprise[] = $entreprise;
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        $this->entreprise->removeElement($entreprise);

        return $this;
    }
}

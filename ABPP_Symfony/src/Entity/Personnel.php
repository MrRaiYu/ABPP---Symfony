<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelRepository::class)
 */
class Personnel
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
    private $PersNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PersMail;

    /**
     * @ORM\Column(type="integer")
     */
    private $PersTel;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="personnels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Fonction::class, inversedBy="personnels")
     */
    private $Fonction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersNom(): ?string
    {
        return $this->PersNom;
    }

    public function setPersNom(string $PersNom): self
    {
        $this->PersNom = $PersNom;

        return $this;
    }

    public function getPersMail(): ?string
    {
        return $this->PersMail;
    }

    public function setPersMail(string $PersMail): self
    {
        $this->PersMail = $PersMail;

        return $this;
    }

    public function getPersTel(): ?int
    {
        return $this->PersTel;
    }

    public function setPersTel(int $PersTel): self
    {
        $this->PersTel = $PersTel;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->Entreprise;
    }

    public function setEntreprise(?Entreprise $Entreprise): self
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->Fonction;
    }

    public function setFonction(?Fonction $Fonction): self
    {
        $this->Fonction = $Fonction;

        return $this;
    }
}

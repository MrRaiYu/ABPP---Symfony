<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
    private $EntRS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EntVille;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $PaysID;

    /**
     * @ORM\ManyToMany(targetEntity=Specialite::class, mappedBy="entreprise")
     * @ORM\JoinTable(name="entreprise_specialite")
     */
    private $specialites;

    /**
     * @ORM\OneToMany(targetEntity=Personnel::class, mappedBy="Entreprise")
     */
    private $personnels;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $Adresse;

    public function __construct()
    {
        $this->specialites = new ArrayCollection();
        $this->personnels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntRS(): ?string
    {
        return $this->EntRS;
    }

    public function setEntRS(string $EntRS): self
    {
        $this->EntRS = $EntRS;

        return $this;
    }

    public function getEntVille(): ?string
    {
        return $this->EntVille;
    }

    public function setEntVille(string $EntVille): self
    {
        $this->EntVille = $EntVille;

        return $this;
    }

    public function getPaysID(): ?Pays
    {
        return $this->PaysID;
    }

    public function setPaysID(?Pays $PaysID): self
    {
        $this->PaysID = $PaysID;

        return $this;
    }
    

    /**
     * @return Collection<int, Specialite>
     */
    public function getSpecialites(): Collection
    {
        return $this->specialites;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialites->contains($specialite)) {
            $this->specialites[] = $specialite;
            $specialite->addEntreprise($this);
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        if ($this->specialites->removeElement($specialite)) {
            $specialite->removeEntreprise($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, Personnel>
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnel $personnel): self
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels[] = $personnel;
            $personnel->setEntreprise($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): self
    {
        if ($this->personnels->removeElement($personnel)) {
            // set the owning side to null (unless already changed)
            if ($personnel->getEntreprise() === $this) {
                $personnel->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }
}

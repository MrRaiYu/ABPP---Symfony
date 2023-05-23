<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
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
    private $UtilLogin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UtilMDP;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilLogin(): ?string
    {
        return $this->UtilLogin;
    }

    public function setUtilLogin(string $UtilLogin): self
    {
        $this->UtilLogin = $UtilLogin;

        return $this;
    }

    public function getUtilMDP(): ?string
    {
        return $this->UtilMDP;
    }

    public function setUtilMDP(string $UtilMDP): self
    {
        $this->UtilMDP = $UtilMDP;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->Profil;
    }

    public function setProfil(?Profil $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }
    public function __toString() {
        return $this->Profil;
    }
}

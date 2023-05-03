<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoginRepository::class)
 */
class Login
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mdp;

/**
     * @ORM\Column(type="string", length=100, nullable=true)
     */

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="logins")
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(?string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;
        return $this;
    }
}
?>
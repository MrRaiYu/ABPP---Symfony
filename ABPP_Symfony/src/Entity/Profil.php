<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
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
    private $ProLib;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProLib(): ?string
    {
        return $this->ProLib;
    }

    public function setProLib(string $ProLib): self
    {
        $this->ProLib = $ProLib;

        return $this;
    }
}

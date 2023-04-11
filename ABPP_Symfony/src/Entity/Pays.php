<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $PaysLib;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaysLib(): ?string
    {
        return $this->PaysLib;
    }

    public function setPaysLib(string $PaysLib): self
    {
        $this->PaysLib = $PaysLib;

        return $this;
    }
}

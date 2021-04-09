<?php

namespace App\Entity;

use App\Repository\LoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoteRepository::class)
 */
class Lote
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
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @ORM\ManyToOne(targetEntity=Delegaciones::class, inversedBy="lotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $delegaciones;

    /**
     * @ORM\Column(type="string")
     */
    private $brochureFilename;

    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getDelegaciones(): ?Delegaciones
    {
        return $this->delegaciones;
    }

    public function setDelegaciones(?Delegaciones $delegaciones): self
    {
        $this->delegaciones = $delegaciones;

        return $this;
    }
}

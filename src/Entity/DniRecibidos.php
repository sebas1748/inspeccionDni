<?php

namespace App\Entity;

use App\Repository\DniRecibidosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DniRecibidosRepository::class)
 * * @ORM\HasLifecycleCallbacks()
 */
class DniRecibidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $fecnac;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $tramite;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $ejemplar;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $fectra;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $ndel;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $delegacion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $feccarga;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $estado;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecreci;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $observa;

    /**
     * @ORM\Column(type="integer")
     */
    private $lote;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getFecnac(): ?string
    {
        return $this->fecnac;
    }

    public function setFecnac(string $fecnac): self
    {
        $this->fecnac = $fecnac;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getTramite(): ?int
    {
        return $this->tramite;
    }

    public function setTramite(int $tramite): self
    {
        $this->tramite = $tramite;

        return $this;
    }

    public function getEjemplar(): ?string
    {
        return $this->ejemplar;
    }

    public function setEjemplar(string $ejemplar): self
    {
        $this->ejemplar = $ejemplar;

        return $this;
    }

    public function getFectra(): ?string
    {
        return $this->fectra;
    }

    public function setFectra(string $fectra): self
    {
        $this->fectra = $fectra;

        return $this;
    }

    public function getNdel(): ?string
    {
        return $this->ndel;
    }

    public function setNdel(string $ndel): self
    {
        $this->ndel = $ndel;

        return $this;
    }

    public function getDelegacion(): ?string
    {
        return $this->delegacion;
    }

    public function setDelegacion(string $delegacion): self
    {
        $this->delegacion = $delegacion;

        return $this;
    }

    public function getFeccarga(): ?\DateTimeInterface
    {
        return $this->feccarga;
    }

    /**
     * @ORM\PrePersist
     */
    public function setFeccarga()
    {
        $this->feccarga = new \DateTime();

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFecreci(): ?\DateTimeInterface
    {
        return $this->fecreci;
    }

    public function setFecreci(?\DateTimeInterface $fecreci): self
    {
        $this->fecreci = $fecreci;

        return $this;
    }

    public function getObserva(): ?string
    {
        return $this->observa;
    }

    public function setObserva(?string $observa): self
    {
        $this->observa = $observa;

        return $this;
    }

    public function getLote(): ?int
    {
        return $this->lote;
    }

    public function setLote(int $lote): self
    {
        $this->lote = $lote;

        return $this;
    }
}

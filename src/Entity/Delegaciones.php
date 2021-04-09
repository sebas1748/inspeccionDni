<?php

namespace App\Entity;

use App\Repository\DelegacionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DelegacionesRepository::class)
 */
class Delegaciones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $ZONA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PARTIDO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DELEGACION;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Campo4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DELEGADO;

    /**
     * @ORM\Column(type="integer")
     */
    private $dep_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CABECERA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dias_atencion_moviles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DOMICILIO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horario;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nac;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $def;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $docs;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $partido_id;

    /**
     * @ORM\OneToMany(targetEntity=Lote::class, mappedBy="delegaciones")
     */
    private $lotes;

    public function __construct()
    {
        $this->lotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZONA(): ?string
    {
        return $this->ZONA;
    }

    public function setZONA(?string $ZONA): self
    {
        $this->ZONA = $ZONA;

        return $this;
    }

    public function getPARTIDO(): ?string
    {
        return $this->PARTIDO;
    }

    public function setPARTIDO(?string $PARTIDO): self
    {
        $this->PARTIDO = $PARTIDO;

        return $this;
    }

    public function getDELEGACION(): ?string
    {
        return $this->DELEGACION;
    }

    public function setDELEGACION(?string $DELEGACION): self
    {
        $this->DELEGACION = $DELEGACION;

        return $this;
    }

    public function getCampo4(): ?string
    {
        return $this->Campo4;
    }

    public function setCampo4(?string $Campo4): self
    {
        $this->Campo4 = $Campo4;

        return $this;
    }

    public function getDELEGADO(): ?string
    {
        return $this->DELEGADO;
    }

    public function setDELEGADO(?string $DELEGADO): self
    {
        $this->DELEGADO = $DELEGADO;

        return $this;
    }

    public function getDepId(): ?int
    {
        return $this->dep_id;
    }

    public function setDepId(int $dep_id): self
    {
        $this->dep_id = $dep_id;

        return $this;
    }

    public function getCABECERA(): ?string
    {
        return $this->CABECERA;
    }

    public function setCABECERA(?string $CABECERA): self
    {
        $this->CABECERA = $CABECERA;

        return $this;
    }

    public function getDiasAtencionMoviles(): ?string
    {
        return $this->dias_atencion_moviles;
    }

    public function setDiasAtencionMoviles(?string $dias_atencion_moviles): self
    {
        $this->dias_atencion_moviles = $dias_atencion_moviles;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDOMICILIO(): ?string
    {
        return $this->DOMICILIO;
    }

    public function setDOMICILIO(?string $DOMICILIO): self
    {
        $this->DOMICILIO = $DOMICILIO;

        return $this;
    }

    public function getHorario(): ?string
    {
        return $this->horario;
    }

    public function setHorario(?string $horario): self
    {
        $this->horario = $horario;

        return $this;
    }

    public function getNac(): ?float
    {
        return $this->nac;
    }

    public function setNac(?float $nac): self
    {
        $this->nac = $nac;

        return $this;
    }

    public function getMat(): ?float
    {
        return $this->mat;
    }

    public function setMat(float $mat): self
    {
        $this->mat = $mat;

        return $this;
    }

    public function getDef(): ?string
    {
        return $this->def;
    }

    public function setDef(?string $def): self
    {
        $this->def = $def;

        return $this;
    }

    public function getDocs(): ?float
    {
        return $this->docs;
    }

    public function setDocs(?float $docs): self
    {
        $this->docs = $docs;

        return $this;
    }

    public function getPartidoId(): ?string
    {
        return $this->partido_id;
    }

    public function setPartidoId(?string $partido_id): self
    {
        $this->partido_id = $partido_id;

        return $this;
    }

    /**
     * @return Collection|Lote[]
     */
    public function getLotes(): Collection
    {
        return $this->lotes;
    }

    public function addLote(Lote $lote): self
    {
        if (!$this->lotes->contains($lote)) {
            $this->lotes[] = $lote;
            $lote->setDelegaciones($this);
        }

        return $this;
    }

    public function removeLote(Lote $lote): self
    {
        if ($this->lotes->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getDelegaciones() === $this) {
                $lote->setDelegaciones(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SeleccionCdrActualRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cdr_final8")
 * @ORM\Entity(repositoryClass=SeleccionCdrActualRepository::class)
 */
class SeleccionCdrActual
{
    /**
     * @ORM\Column(name="empleado_cl", type="integer", nullable=true)
     * @ORM\Id
     */
    private $empleado;

    /**
     * @ORM\Column(name="tit_sup_xx", type="string", length=1, nullable=true)
     */
    private $titularSuplente;

    /**
     * @ORM\Column(name="nombre_xx", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="sexo_xx", type="string", length=10, nullable=true)
     */
    private $genero;

    /**
     * @ORM\Column(name="unidad_xx", type="string", length=30, nullable=true)
     */
    private $nombreUnidad;

    /**
     * @ORM\Column(name="division_xx", type="string", length=50, nullable=true)
     */
    private $nombreDivision;


    /**
     * @ORM\Column(name="linea_cono_xx", type="string", length=50, nullable=true)
     */
    private $nombreDisciplina;

    public function getEmpleado(): ?int
    {
        return $this->empleado;
    }

    public function getTitularSuplente(): ?string
    {
        return $this->titularSuplente;
    }

    public function setTitularSuplente(?string $titularSuplente): self
    {
        $this->titularSuplente = $titularSuplente;

        return $this;
    }

    public function getNombreUnidad(): ?string
    {
        return $this->nombreUnidad;
    }

    public function setNombreUnidad(?string $nombreUnidad): self
    {
        $this->nombreUnidad = $nombreUnidad;

        return $this;
    }

    public function getNombreDivision(): ?string
    {
        return $this->nombreDivision;
    }

    public function setNombreDivision(?string $nombreDivision): self
    {
        $this->nombreDivision = $nombreDivision;

        return $this;
    }

    public function getNombreDepartamento(): ?string
    {
        return $this->nombreDepartamento;
    }

    public function setNombreDepartamento(?string $nombreDepartamento): self
    {
        $this->nombreDepartamento = $nombreDepartamento;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }


    public function getNombreDisciplina(): ?string
    {
        return $this->nombreDisciplina;
    }

    public function getDisciplina(): ?string
    {
        return $this->nombreDisciplina;
    }

    public function setNombreDisciplina(?string $nombreDisciplina): self
    {
        $this->nombreDisciplina = $nombreDisciplina;

        return $this;
    }
}

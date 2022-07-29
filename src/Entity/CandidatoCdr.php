<?php

namespace App\Entity;

use App\Repository\CandidatoCdrRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="candidato_cdr8")
 * @ORM\Entity(repositoryClass=CandidatoCdrRepository::class)
 */
class CandidatoCdr
{
    /**
     * @ORM\Column(name="trimestre_cl" ,type="string", length=3, nullable=true)
     * @ORM\Id
     */
    private $trimestre;

    /**
     * @ORM\Column(name="empleado_cl", type="integer", nullable=true)
     * @ORM\Id
     */
    private $empleado;

    /**
     * @ORM\Column(name="unidad_cl", type="string", length=3, nullable=true)
     */
    private $claveUnidad;

    /**
     * @ORM\Column(name="division_cl", type="string", length=3, nullable=true)
     */
    private $claveDivision;

    /**
     * @ORM\Column(name="aleatorio_nu", type="float", nullable=true)
     */
    private $aleatorio;

    /**
     * @ORM\Column(name="genero_xx", type="string", length=1, nullable=true)
     */
    private $genero;

    /**
     * @ORM\Column(name="uni_rep_cl", type="string", length=3, nullable=true)
     */
    private $claveUnidadRepresentada;

    /**
     * @ORM\Column(name="div_rep_cl", type="string", length=3, nullable=true)
     */
    private $claveDivisionRepresentada;

    /**
     * @ORM\Column(name="uni_rep_xx", type="string", length=30, nullable=true)
     */
    private $nombreUnidadRepresentada;

    /**
     * @ORM\Column(name="div_rep_xx", type="string", length=50, nullable=true)
     */
    private $nombreDivisionRepresentada;

    /**
     * @ORM\Column(name="nom_aux_xx", type="string", length=10, nullable=true)
     */
    private $nomAux;

    /**
     * @ORM\Column(name="disciplina_cl", type="integer", nullable=true)
     */
    private $claveDisiplina;

    /**
     * @ORM\Column(name="seleccion_xx", type="string", length=1, nullable=true)
     */
    private $seleccion;

    /**
     * @ORM\Column(name="tit_sup_xx", type="string", length=1, nullable=true)
     */
    private $titularSuplente;

    /**
     * @ORM\Column(name="excluir_xx", type="string", length=1, nullable=true)
     */
    private $excluir;

    /**
     * @ORM\Column(name="unidad_xx", type="string", length=30, nullable=true)
     */
    private $nombreUnidad;

    /**
     * @ORM\Column(name="division_xx", type="string", length=50, nullable=true)
     */
    private $nombreDivision;

    /**
     * @ORM\Column(name="depto_xx", type="string", length=100, nullable=true)
     */
    private $nombreDepartamento;

    /**
     * @ORM\Column(name="nombre_xx", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="sexo_xx", type="string", length=10, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(name="antig_xx", type="string", length=20, nullable=true)
     */
    private $antiguedad;

    /**
     * @ORM\Column(name="titular_xx", type="string", length=1, nullable=true)
     */
    private $titular;

    /**
     * @ORM\Column(name="tec_acad_xx", type="string", length=1, nullable=true)
     */
    private $tecnicoAcademico;

    /**
     * @ORM\Column(name="bap_xx", type="string", length=50, nullable=true)
     */
    private $bap;

    /**
     * @ORM\Column(name="linea_cono_xx", type="string", length=255, nullable=true)
     */
    private $lineaConosimiento;

    /**
     * @ORM\Column(name="cda_eval_xx", type="string", length=100, nullable=true)
     */
    private $cdaEval;

    /**
     * @ORM\Column(name="cda_mmbro_xx", type="string", length=100, nullable=true)
     */
    private $cdaMiembro;

    /**
     * @ORM\Column(name="periodos_xx", type="string", length=255, nullable=true)
     */
    private $periodos;

    public function getTrimestre(): ?string
    {
        return $this->trimestre;
    }

    public function setTrimestre(string $trimestre): self
    {
        $this->trimestre = $trimestre;

        return $this;
    }

    public function getEmpleado(): ?int
    {
        return $this->empleado;
    }

    public function setEmpleado(int $empleado): self
    {
        $this->empleado = $empleado;

        return $this;
    }

    public function getClaveUnidad(): ?string
    {
        return $this->claveUnidad;
    }

    public function setClaveUnidad(string $claveUnidad): self
    {
        $this->claveUnidad = $claveUnidad;

        return $this;
    }

    public function getClaveDivision(): ?string
    {
        return $this->claveDivision;
    }

    public function setClaveDivision(string $claveDivision): self
    {
        $this->claveDivision = $claveDivision;

        return $this;
    }

    public function getAleatorio(): ?float
    {
        return $this->aleatorio;
    }

    public function setAleatorio(float $aleatorio): self
    {
        $this->aleatorio = $aleatorio;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getClaveUnidadRepresentada(): ?string
    {
        return $this->claveUnidadRepresentada;
    }

    public function setClaveUnidadRepresentada(string $claveUnidadRepresentada): self
    {
        $this->claveUnidadRepresentada = $claveUnidadRepresentada;

        return $this;
    }

    public function getClaveDivisionRepresentada(): ?string
    {
        return $this->claveDivisionRepresentada;
    }

    public function setClaveDivisionRepresentada(string $claveDivisionRepresentada): self
    {
        $this->claveDivisionRepresentada = $claveDivisionRepresentada;

        return $this;
    }

    public function getNombreUnidadRepresentada(): ?string
    {
        return $this->nombreUnidadRepresentada;
    }

    public function setNombreUnidadRepresentada(string $nombreUnidadRepresentada): self
    {
        $this->nombreUnidadRepresentada = $nombreUnidadRepresentada;

        return $this;
    }

    public function getNombreDivisionRepresentada(): ?string
    {
        return $this->nombreDivisionRepresentada;
    }

    public function setNombreDivisionRepresentada(string $nombreDivisionRepresentada): self
    {
        $this->nombreDivisionRepresentada = $nombreDivisionRepresentada;

        return $this;
    }

    public function getNomAux(): ?string
    {
        return $this->nomAux;
    }

    public function setNomAux(?string $nomAux): self
    {
        $this->nomAux = $nomAux;

        return $this;
    }

    public function getClaveDisiplina(): ?int
    {
        return $this->claveDisiplina;
    }

    public function setClaveDisiplina(?int $claveDisiplina): self
    {
        $this->claveDisiplina = $claveDisiplina;

        return $this;
    }

    public function getSeleccion(): ?string
    {
        return $this->seleccion;
    }

    public function setSeleccion(string $seleccion): self
    {
        $this->seleccion = $seleccion;

        return $this;
    }

    public function getTitularSuplente(): ?string
    {
        return $this->titularSuplente;
    }

    public function setTitularSuplente(string $titularSuplente): self
    {
        $this->titularSuplente = $titularSuplente;

        return $this;
    }

    public function getExcluir(): ?string
    {
        return $this->excluir;
    }

    public function setExcluir(string $excluir): self
    {
        $this->excluir = $excluir;

        return $this;
    }

    public function getNombreUnidad(): ?string
    {
        return $this->nombreUnidad;
    }

    public function setNombreUnidad(string $nombreUnidad): self
    {
        $this->nombreUnidad = $nombreUnidad;

        return $this;
    }

    public function getNombreDivision(): ?string
    {
        return $this->nombreDivision;
    }

    public function setNombreDivision(string $nombreDivision): self
    {
        $this->nombreDivision = $nombreDivision;

        return $this;
    }

    public function getNombreDepartamento(): ?string
    {
        return $this->nombreDepartamento;
    }

    public function setNombreDepartamento(string $nombreDepartamento): self
    {
        $this->nombreDepartamento = $nombreDepartamento;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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

    public function getAntiguedad(): ?string
    {
        return $this->antiguedad;
    }

    public function setAntiguedad(string $antiguedad): self
    {
        $this->antiguedad = $antiguedad;

        return $this;
    }

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): self
    {
        $this->titular = $titular;

        return $this;
    }

    public function getTecnicoAcademico(): ?string
    {
        return $this->tecnicoAcademico;
    }

    public function setTecnicoAcademico(string $tecnicoAcademico): self
    {
        $this->tecnicoAcademico = $tecnicoAcademico;

        return $this;
    }

    public function getBap(): ?string
    {
        return $this->bap;
    }

    public function setBap(string $bap): self
    {
        $this->bap = $bap;

        return $this;
    }

    public function getLineaConosimiento(): ?string
    {
        return $this->lineaConosimiento;
    }

    public function setLineaConosimiento(string $lineaConosimiento): self
    {
        $this->lineaConosimiento = $lineaConosimiento;

        return $this;
    }

    public function getCdaEval(): ?string
    {
        return $this->cdaEval;
    }

    public function setCdaEval(string $cdaEval): self
    {
        $this->cdaEval = $cdaEval;

        return $this;
    }

    public function getCdaMiembro(): ?string
    {
        return $this->cdaMiembro;
    }

    public function setCdaMiembro(string $cdaMiembro): self
    {
        $this->cdaMiembro = $cdaMiembro;

        return $this;
    }

    public function getPeriodos(): ?string
    {
        return $this->periodos;
    }

    public function setPeriodos(string $periodos): self
    {
        $this->periodos = $periodos;

        return $this;
    }

    public function getTitularSupplente(): ?string
    {
        return $this->titularSupplente;
    }

    public function setTitularSupplente(string $titularSupplente): self
    {
        $this->titularSupplente = $titularSupplente;

        return $this;
    }
}

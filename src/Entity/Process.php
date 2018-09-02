<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Process
 *
 * @ORM\Table(name="process")
 * @ORM\Entity(repositoryClass="App\Repository\ProcessRepository")
 * @UniqueEntity(
 *      fields = {"processNumber"},
 *      message = "Este número de proceso ya existe"
 * )
 */
class Process
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      exactMessage = "El proceso debe copntener 8 caracteres exactamente"
     * )
     * @ORM\Column(type="string", length=8, unique=true)
     */
    private $processNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 200,
     *      maxMessage = "La descripción debe ser máximo de 200 caracteres"
     * )
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreate;

    /**
     * @Assert\Type(
     *    type="float",
     *    message="El valor no es un número válido."
     * )
     * @ORM\Column(type="float", nullable=true)
     */
    private $budget;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Places", inversedBy="processes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $process_place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProcessNumber(): ?string
    {
        return $this->processNumber;
    }

    public function setProcessNumber(string $processNumber): self
    {
        $this->processNumber = $processNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function CopToDollar($cop)       
    {   
        // El API de Amdoren cuenta con un limite de 50 peticiones mensual. para usar mas adquirir verion pro
        // $get = file_get_contents("https://www.amdoren.com/api/currency.php?api_key=fGN5pnaAeVnFKAP4wrPv6Lw7AhXadj&from=COP&to=USD&amount=".$cop);
        // $data =json_decode($get,true);
        // return round($data['amount'], 2);
        return round($cop / 3070.65, 2);
    }

    public function setBudget(?float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getProcessPlace(): ?Places
    {
        return $this->process_place;
    }

    public function setProcessPlace(?Places $process_place): self
    {
        $this->process_place = $process_place;

        return $this;
    }
}

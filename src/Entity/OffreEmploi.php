<?php

namespace App\Entity;

use App\Repository\OffreEmploiRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OffreEmploiRepository::class)
 */
class OffreEmploi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $titre;
    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $competences_requises;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $date_limite;

   
    /**
     * @ORM\ManyToOne(targetEntity=Employeurs::class, inversedBy="OffreEmploi")
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $employeurs;

    /**
     * @ORM\Column(type="boolean" ,nullable=false)
     * @Groups({"GetOffreEmpoyeur"})
     */
    private $isAccepted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Category;





    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getCompetencesRequises(): ?string
    {
        return $this->competences_requises;
    }

    public function setCompetencesRequises(string $competences_requises): self
    {
        $this->competences_requises = $competences_requises;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDateLimite(): ?string
    {
        return $this->date_limite;
    }

    public function setDateLimite(string $date_limite): self
    {
        $this->date_limite = $date_limite;

        return $this;
    }

    public function getEmployeurs(): ?Employeurs
    {
        return $this->employeurs;
    }

    public function setEmployeurs(?Employeurs $employeurs): self
    {
        $this->employeurs = $employeurs;

        return $this;
    }

    public function isIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
        }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

   
}

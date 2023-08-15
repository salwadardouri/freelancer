<?php

namespace App\Entity;

use App\Repository\FreelancerRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FreelancerRepository::class)
 */
class Freelancer extends User 
{
   
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $competences;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $Cv;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $Photo;


    
    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(string $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->Cv;
    }

    public function setCv(string $Cv): self
    {
        $this->Cv = $Cv;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

   
}

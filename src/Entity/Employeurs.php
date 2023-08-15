<?php

namespace App\Entity;

use App\Repository\EmployeursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EmployeursRepository::class)
 */
class Employeurs extends User 
{
   
    /**
     * @ORM\OneToMany(targetEntity=OffreEmploi::class, mappedBy="employeurs")
     */
    private $OffreEmploi;

 
    public function __construct()
    {
        $this->OffreEmploi = new ArrayCollection();
    }

    

    /**
     * @return Collection<int, OffreEmploi>
     */
    public function getOffreEmploi(): Collection
    {
        return $this->OffreEmploi;
    }

    public function addOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if (!$this->OffreEmploi->contains($offreEmploi)) {
            $this->OffreEmploi[] = $offreEmploi;
            $offreEmploi->setEmployeurs($this);
        }

        return $this;
    }

    public function removeOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if ($this->OffreEmploi->removeElement($offreEmploi)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploi->getEmployeurs() === $this) {
                $offreEmploi->setEmployeurs(null);
            }
        }

        return $this;
    }

    
}
